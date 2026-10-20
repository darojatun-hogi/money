<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

// Skema role/permission bersama semua app (money, clip, ...):
// - permission "resource.action"; milik app diberi awalan app, identitas (users/roles/permissions) tanpa awalan
// - role "super-admin" + "<app>.admin" / "<app>.user"
// Hanya mengganti nama yang lama bila masih ada, jadi aman di instalasi baru (seeder sudah memakai nama baru).
return new class extends Migration
{
    protected $connection = 'supabase';

    private array $permissions = [
        'view-dashboard' => 'money.dashboard.view',
        'view-users' => 'users.view', 'create-users' => 'users.create', 'edit-users' => 'users.edit', 'delete-users' => 'users.delete',
        'view-roles' => 'roles.view', 'create-roles' => 'roles.create', 'edit-roles' => 'roles.edit', 'delete-roles' => 'roles.delete',
        'view-permissions' => 'permissions.view', 'create-permissions' => 'permissions.create', 'edit-permissions' => 'permissions.edit', 'delete-permissions' => 'permissions.delete',
        'view-menus' => 'money.menus.view', 'create-menus' => 'money.menus.create', 'edit-menus' => 'money.menus.edit', 'delete-menus' => 'money.menus.delete',
        'view-categories' => 'money.categories.view', 'create-categories' => 'money.categories.create', 'edit-categories' => 'money.categories.edit', 'delete-categories' => 'money.categories.delete',
        'view-transaction-names' => 'money.transaction-names.view', 'create-transaction-names' => 'money.transaction-names.create', 'edit-transaction-names' => 'money.transaction-names.edit', 'delete-transaction-names' => 'money.transaction-names.delete',
        'view-wallets' => 'money.wallets.view', 'create-wallets' => 'money.wallets.create', 'edit-wallets' => 'money.wallets.edit', 'delete-wallets' => 'money.wallets.delete',
        'view-transactions' => 'money.transactions.view', 'create-transactions' => 'money.transactions.create', 'edit-transactions' => 'money.transactions.edit', 'delete-transactions' => 'money.transactions.delete',
        'view-feedbacks' => 'money.feedbacks.view', 'create-feedbacks' => 'money.feedbacks.create', 'edit-feedbacks' => 'money.feedbacks.edit', 'delete-feedbacks' => 'money.feedbacks.delete',
    ];

    private array $roles = ['admin' => 'money.admin', 'user' => 'money.user'];

    public function up(): void
    {
        $db = DB::connection($this->connection);

        $db->transaction(function () use ($db) {
            // Pemegang role "admin" lama (pemilik) menjadi super-admin
            $superAdmin = $this->firstOrCreateRole($db, 'super-admin');
            $oldAdmin = $db->table('roles')->where('name', 'admin')->where('guard_name', 'web')->value('id');
            if ($oldAdmin) {
                foreach ($db->table('model_has_roles')->where('role_id', $oldAdmin)->get() as $row) {
                    $db->table('model_has_roles')->updateOrInsert(
                        ['role_id' => $superAdmin, 'model_type' => $row->model_type, 'model_id' => $row->model_id]
                    );
                }
            }

            foreach ($this->permissions as $old => $new) {
                $this->rename($db, 'permissions', $old, $new);
            }
            foreach ($this->roles as $old => $new) {
                $this->rename($db, 'roles', $old, $new);
            }

            // Izin masuk app: money.access untuk money.admin & money.user
            $access = $this->firstOrCreate($db, 'permissions', 'money.access');
            foreach (['money.admin', 'money.user'] as $role) {
                $roleId = $db->table('roles')->where('name', $role)->where('guard_name', 'web')->value('id');
                if ($roleId) {
                    $db->table('role_has_permissions')->updateOrInsert(['permission_id' => $access, 'role_id' => $roleId]);
                }
            }
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        $db = DB::connection($this->connection);

        $db->transaction(function () use ($db) {
            foreach (array_flip($this->permissions) as $new => $old) {
                $this->rename($db, 'permissions', $new, $old);
            }
            foreach (array_flip($this->roles) as $new => $old) {
                $this->rename($db, 'roles', $new, $old);
            }
            $db->table('permissions')->where('name', 'money.access')->delete();
        });

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    private function rename($db, string $table, string $from, string $to): void
    {
        $exists = $db->table($table)->where('name', $to)->where('guard_name', 'web')->exists();
        if (! $exists) {
            $db->table($table)->where('name', $from)->where('guard_name', 'web')->update(['name' => $to, 'updated_at' => now()]);
        }
    }

    private function firstOrCreateRole($db, string $name): int
    {
        return $this->firstOrCreate($db, 'roles', $name);
    }

    private function firstOrCreate($db, string $table, string $name): int
    {
        $id = $db->table($table)->where('name', $name)->where('guard_name', 'web')->value('id');

        return $id ?? $db->table($table)->insertGetId([
            'name' => $name, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now(),
        ]);
    }
};
