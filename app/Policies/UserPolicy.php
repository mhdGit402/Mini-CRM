<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view edit models.
     */
    public function edit(User $user): bool
    {
        return true;
        // return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return true;
        // return $user->id === $task->user_id;
    }
}
