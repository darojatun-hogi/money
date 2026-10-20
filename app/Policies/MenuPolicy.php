<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;

class MenuPolicy
{
    public function before(User $user): bool|null
    {
        if ($user->hasRole('money.admin')) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('money.menus.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.menus.create');
    }

    public function update(User $user, Menu $menu): bool
    {
        return $user->hasPermissionTo('money.menus.edit');
    }

    public function delete(User $user, Menu $menu): bool
    {
        return $user->hasPermissionTo('money.menus.delete');
    }
}
