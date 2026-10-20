<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'money.access', 'money.dashboard.view',
            'users.view',    'users.create',    'users.edit',    'users.delete',
            'roles.view',    'roles.create',    'roles.edit',    'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete',
            'money.menus.view',    'money.menus.create',    'money.menus.edit',    'money.menus.delete',
            // Finance permissions
            'money.categories.view',        'money.categories.create',        'money.categories.edit',        'money.categories.delete',
            'money.transaction-names.view', 'money.transaction-names.create', 'money.transaction-names.edit', 'money.transaction-names.delete',
            'money.wallets.view',           'money.wallets.create',           'money.wallets.edit',           'money.wallets.delete',
            'money.transactions.view',      'money.transactions.create',      'money.transactions.edit',      'money.transactions.delete',
            // Feedback permissions
            'money.feedbacks.view',         'money.feedbacks.create',         'money.feedbacks.edit',          'money.feedbacks.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
