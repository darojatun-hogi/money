<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
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
        return $user->hasPermissionTo('money.transactions.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.transactions.create');
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('money.transactions.edit')
            && $transaction->user_id === $user->id;
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->hasPermissionTo('money.transactions.delete')
            && $transaction->user_id === $user->id;
    }
}
