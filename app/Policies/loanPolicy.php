<?php

namespace App\Policies;

use App\Models\User;
use App\Models\loan;
use Illuminate\Auth\Access\Response;

class loanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, loan $loan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, loan $loan): bool
    {
        return $loan->tool->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, loan $loan): bool
    {
        return $this->update($user, $loan);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, loan $loan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, loan $loan): bool
    {
        //
    }
}
