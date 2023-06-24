<?php

namespace App\Policies;

use App\Models\QuestionRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuestionRequestPolicy
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
    public function view(User $user, QuestionRequest $questionRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user && $user->type == "t";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, QuestionRequest $questionRequest): bool
    {
        return $user && $user->type == "a";
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, QuestionRequest $questionRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, QuestionRequest $questionRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, QuestionRequest $questionRequest): bool
    {
        //
    }
}
