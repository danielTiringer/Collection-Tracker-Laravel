<?php

namespace App\Policies;

use App\Models\CollectionEntity;
use App\Models\User;

class CollectionEntityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CollectionEntity $collectionEntity): bool
    {
        return $user->id === $collectionEntity->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CollectionEntity $collectionEntity): bool
    {
        return $user->id === $collectionEntity->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CollectionEntity $collectionEntity): bool
    {
        return $user->id === $collectionEntity->user_id;
    }

    /**
     * Determine whether the user can add related elements to the model.
     */
    public function createElement(User $user, CollectionEntity $collectionEntity): bool
    {
        return $user->id === $collectionEntity->user_id;
    }
}
