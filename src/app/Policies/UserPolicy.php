<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $editingUser, User $editedUser): bool
    {
        return $editingUser->id === $editedUser->id;
    }

    public function updatePassword(User $editingUser, User $editedUser): bool
    {
        return $editingUser->id === $editedUser->id;
    }
}
