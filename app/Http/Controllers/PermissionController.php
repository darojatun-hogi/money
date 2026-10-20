<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

// Permission terpusat di Supabase: daftar menampilkan milik money + identitas bersama,
// tapi hanya permission berawalan "money." yang boleh dibuat, diubah, atau dihapus di sini
class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Permission::class);
        $query = Permission::forApp();

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }

        $permissions = $query->latest()->paginate(10)->onEachSide(1)->withQueryString();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $this->authorize('create', Permission::class);
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);
        $request->validate([
            'name' => 'required|string|starts_with:' . Role::appPrefix() . '|unique:supabase.permissions,name',
        ]);

        Permission::create(['name' => $request->name, 'guard_name' => 'web']);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(string $id)
    {
        $permission = $this->findOwned($id);
        $this->authorize('update', $permission);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, string $id)
    {
        $permission = $this->findOwned($id);
        $this->authorize('update', $permission);
        $request->validate([
            'name' => 'required|string|starts_with:' . Role::appPrefix() . '|unique:supabase.permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(string $id)
    {
        $permission = $this->findOwned($id);
        $this->authorize('delete', $permission);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }

    private function findOwned(string $id): Permission
    {
        return Permission::where('name', 'like', Role::appPrefix() . '%')->findOrFail($id);
    }
}
