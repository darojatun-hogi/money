<?php

return [

    /*
    | Nama app ini di skema role/permission bersama (Supabase). Role dan permission
    | milik app diberi awalan "<app>.", misalnya money.admin dan money.wallets.view.
    | User hanya boleh masuk bila punya permission "<app>.access" (atau role super-admin).
    */

    'app' => 'money',

    'super_admin_role' => 'super-admin',

    // Permission identitas yang dipakai bersama oleh semua app (tanpa awalan app)
    'shared_permissions' => [
        'users.view', 'users.create', 'users.edit', 'users.delete',
        'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
        'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete',
        'activity-log.view',
    ],

];
