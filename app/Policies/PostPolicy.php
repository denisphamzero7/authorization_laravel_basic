<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->group) {
            $roleJson = $user->group->permissions;
            if (!empty($roleJson)) {
                $roleArr = json_decode($roleJson, true);
                $check = isRole($roleArr, 'posts');
                return $check;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->group) {
            $roleJson = $user->group->permissions;
            if (!empty($roleJson)) {
                $roleArr = json_decode($roleJson, true);
                $check = isRole($roleArr, 'posts', 'add');
                return $check;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->id === $post->user_id) {
            return true;
        }

        if ($user->group) {
            $roleJson = $user->group->permissions;
            if (!empty($roleJson)) {
                $roleArr = json_decode($roleJson, true);
                return isRole($roleArr, 'posts', 'edit');
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->id === $post->user_id) {
            return true;
        }

        if ($user->group) {
            $roleJson = $user->group->permissions;
            if (!empty($roleJson)) {
                $roleArr = json_decode($roleJson, true);
                return isRole($roleArr, 'posts', 'delete');
            }
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
