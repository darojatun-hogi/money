<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;

class WalletPolicy
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
        return $user->hasPermissionTo('money.wallets.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.wallets.create');
    }

    public function update(User $user, Wallet $wallet): bool
    {
        return $user->hasPermissionTo('money.wallets.edit')
            && $wallet->user_id === $user->id;
    }

    public function delete(User $user, Wallet $wallet): bool
    {
        return $user->hasPermissionTo('money.wallets.delete')
            && $wallet->user_id === $user->id;
    }
}
