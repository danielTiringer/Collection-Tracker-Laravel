<?php

namespace App\Policies;

use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\User;

class CollectionElementPolicy
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
    public function view(User $user, CollectionElement $collectionElement): bool
    {
        return $user->id === $collectionElement->entity->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CollectionElement $collectionElement): bool
    {
        return $user->id === $collectionElement->entity->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CollectionElement $collectionElement): bool
    {
        return $user->id === $collectionElement->entity->user_id;
    }
}
