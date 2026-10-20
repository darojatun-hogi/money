<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('money.admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('money.categories.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.categories.create');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('money.categories.edit')
            && $category->user_id === $user->id;
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('money.categories.delete')
            && $category->user_id === $user->id;
    }
}
