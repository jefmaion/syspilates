<?php

namespace App\Policies;

use App\Models\Modality;
use App\Models\User;

class ModalityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list modality');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Modality $modality): bool
    {
        return $user->can('list modality');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create modality');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Modality $modality): bool
    {

        return $user->can('edit modality');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Modality $modality): bool
    {
        return $user->can('delete modality');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Modality $modality): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Modality $modality): bool
    {
        return false;
    }
}
