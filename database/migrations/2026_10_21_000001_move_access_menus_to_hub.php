<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// User, role, dan permission money dikelola di hub SSO (auth.elips.id): menu lama diganti satu tautan "Kelola Akses"
return new class extends Migration
{
    public function up(): void
    {
        DB::table('menus')->where('route_name', 'users.index')->update([
            'name' => 'Kelola Akses',
            'icon' => 'tabler:shield-lock',
            'route_name' => 'access.manage',
        ]);

        DB::table('menus')->whereIn('route_name', ['roles.index', 'permissions.index'])->update(['is_active' => false]);

        // Dropdown lama "Roles & Permission" sekarang hanya berisi Menus
        DB::table('menus')->where('name', 'Roles & Permission')->update(['name' => 'Pengaturan']);
    }

    public function down(): void
    {
        DB::table('menus')->where('route_name', 'access.manage')->update([
            'name' => 'Users',
            'icon' => 'tabler:users',
            'route_name' => 'users.index',
        ]);

        DB::table('menus')->whereIn('route_name', ['roles.index', 'permissions.index'])->update(['is_active' => true]);
        DB::table('menus')->where('name', 'Pengaturan')->update(['name' => 'Roles & Permission']);
    }
};
