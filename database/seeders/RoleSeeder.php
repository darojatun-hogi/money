<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // super-admin: semua akses di semua app lewat Gate::before, tanpa daftar permission
        Role::firstOrCreate(['name' => config('access.super_admin_role'), 'guard_name' => 'web']);

        // money.admin: semua permission money + identitas bersama
        $admin = Role::firstOrCreate(['name' => 'money.admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::forApp()->get());

        // money.user: masuk app + dashboard + CRUD keuangan miliknya
        $user = Role::firstOrCreate(['name' => 'money.user', 'guard_name' => 'web']);
        $user->syncPermissions([
            'money.access', 'money.dashboard.view',
            'money.wallets.view',    'money.wallets.create',    'money.wallets.edit',    'money.wallets.delete',
            'money.transactions.view', 'money.transactions.create', 'money.transactions.edit', 'money.transactions.delete',
            'money.categories.view', 'money.categories.create', 'money.categories.edit', 'money.categories.delete',
            'money.transaction-names.view', 'money.transaction-names.create', 'money.transaction-names.edit', 'money.transaction-names.delete',
            'money.feedbacks.create',
        ]);
    }
}
