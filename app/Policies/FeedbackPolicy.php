<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;

class FeedbackPolicy
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
        return $user->hasPermissionTo('money.feedbacks.view');
    }

    public function view(User $user, Feedback $feedback): bool
    {
        return $user->hasPermissionTo('money.feedbacks.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('money.feedbacks.create');
    }

    public function update(User $user, Feedback $feedback): bool
    {
        return $user->hasPermissionTo('money.feedbacks.edit');
    }

    public function delete(User $user, Feedback $feedback): bool
    {
        return $user->hasPermissionTo('money.feedbacks.delete');
    }
}
