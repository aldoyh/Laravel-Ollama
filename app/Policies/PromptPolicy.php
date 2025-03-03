<?php

namespace App\Policies;

use App\Models\Prompt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PromptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view prompts
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prompt $prompt): bool
    {
        // Users can view their own prompts or public prompts
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create prompts
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user): ?bool
    {
        if ($user->is_admin) {
            return true;
        }

        return null;
    }
}
