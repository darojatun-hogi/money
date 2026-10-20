<?php

namespace App\Policies;

use App\Models\TransactionName;
use App\Models\User;

class TransactionNamePolicy
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
        return $user->hasPermissionTo('money.transaction-names.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.transaction-names.create');
    }

    public function update(User $user, TransactionName $transactionName): bool
    {
        return $user->hasPermissionTo('money.transaction-names.edit')
            && $transactionName->user_id === $user->id;
    }

    public function delete(User $user, TransactionName $transactionName): bool
    {
        return $user->hasPermissionTo('money.transaction-names.delete')
            && $transactionName->user_id === $user->id;
    }
}
