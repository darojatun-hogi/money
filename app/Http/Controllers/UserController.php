<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\Role;

// Tabel users dipakai bersama banyak app: halaman ini hanya mengelola user & role milik app ini
class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $query = User::with('roles')->withAppAccess();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ilike', '%' . $request->search . '%')
                    ->orWhere('email', 'ilike', '%' . $request->search . '%')
                    ->orWhere('username', 'ilike', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', fn($q) => $q->where('name', $request->role));
        }

        $users = $query->latest()->paginate(10)->onEachSide(1)->withQueryString();
        $roles  = Role::forApp()->orderBy('name')->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::forApp()->orderBy('name')->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:supabase.users,username|alpha_dash',
            'email'    => 'required|email|unique:supabase.users,email',
            'password' => ['required', Password::min(8)],
            'roles'    => 'nullable|array',
            'roles.*'  => [Rule::in(Role::forApp()->pluck('name'))],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncAppRoles($request->filled('roles') ? $request->roles : [Role::appPrefix().'user']);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $roles        = Role::forApp()->orderBy('name')->get();
        $currentRoles = $user->roles->pluck('name')->toArray();
        return view('users.edit', compact('user', 'roles', 'currentRoles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:supabase.users,username,' . $user->id . '|alpha_dash',
            'email'    => 'required|email|unique:supabase.users,email,' . $user->id,
            'password' => ['nullable', Password::min(8)],
            'roles'    => 'required|array',
            'roles.*'  => [Rule::in(Role::forApp()->pluck('name'))],
        ]);

        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            ...($request->filled('password') ? ['password' => Hash::make($request->password)] : []),
        ]);

        $user->syncAppRoles($request->roles ?? []);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Akun dipakai app lain juga, jadi "hapus" di sini = cabut akses ke app ini, bukan hapus akun
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa mencabut akses akun sendiri.');
        }

        $user->syncAppRoles([]);
        return redirect()->route('users.index')->with('success', 'Akses user ke aplikasi ini dicabut.');
    }
}
