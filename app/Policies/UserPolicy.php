<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->isAdmin() || $user->is($model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->isAdmin() || $user->is($model);
    }

    /**
     * Determine whether the user can update the type of the model.
     *
     * @return mixed
     */
    public function updateType(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }
}
