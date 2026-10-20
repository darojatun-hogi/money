<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\Permission;

// Role terpusat di Supabase: halaman ini hanya mengelola role berawalan "money."
class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);
        $query = Role::forApp()->with('permissions');

        if ($request->filled('search')) {
            $query->where('name', 'ilike', '%' . $request->search . '%');
        }

        $roles = $query->latest()->paginate(10)->onEachSide(1)->withQueryString();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);
        $permissions = Permission::forApp()->orderBy('name')->get();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $request->validate([
            'name' => 'required|string|starts_with:' . Role::appPrefix() . '|unique:supabase.roles,name',
            'permissions' => 'array',
            'permissions.*' => [Rule::in(Permission::forApp()->pluck('name'))],
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role successfully created.');
    }

    public function edit(string $id)
    {
        $role = Role::forApp()->findOrFail($id);
        $this->authorize('update', $role);
        $permissions = Permission::forApp()->orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::forApp()->findOrFail($id);
        $this->authorize('update', $role);
        $request->validate([
            'name' => 'required|string|starts_with:' . Role::appPrefix() . '|unique:supabase.roles,name,' . $role->id,
            'permissions' => 'array',
            'permissions.*' => [Rule::in(Permission::forApp()->pluck('name'))],
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'Role successfully updated.');
    }

    public function destroy(Role $role)
    {
        abort_unless(str_starts_with($role->name, Role::appPrefix()), 404);
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role successfully deleted.');
    }
}
