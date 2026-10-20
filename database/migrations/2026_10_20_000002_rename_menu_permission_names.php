<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Sesuaikan menus.permission_name dengan nama permission baru (lihat migration rename_roles_permissions_to_shared_scheme)
return new class extends Migration
{
    private array $names = [
        'view-dashboard' => 'money.dashboard.view',
        'view-users' => 'users.view',
        'view-roles' => 'roles.view',
        'view-permissions' => 'permissions.view',
        'view-menus' => 'money.menus.view',
        'view-categories' => 'money.categories.view',
        'view-transaction-names' => 'money.transaction-names.view',
        'view-wallets' => 'money.wallets.view',
        'view-transactions' => 'money.transactions.view',
        'create-feedbacks' => 'money.feedbacks.create',
        'view-feedbacks' => 'money.feedbacks.view',
    ];

    public function up(): void
    {
        foreach ($this->names as $old => $new) {
            DB::table('menus')->where('permission_name', $old)->update(['permission_name' => $new]);
        }
    }

    public function down(): void
    {
        foreach ($this->names as $old => $new) {
            DB::table('menus')->where('permission_name', $new)->update(['permission_name' => $old]);
        }
    }
};
