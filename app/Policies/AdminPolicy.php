<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any admins.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Admin $admin
     * @return mixed
     */
    public function view(User $user, Admin $admin)
    {
        return $user->isAdmin() || $user->is($admin);
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Admin $admin
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        return $user->isAdmin() || $user->is($admin);
    }

    /**
     * Determine whether the user can update the type of the admin.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Admin $admin
     * @return mixed
     */
    public function updateType(User $user, Admin $admin)
    {
        return $user->isAdmin() && $user->isNot($admin);
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Admin $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        return $user->isAdmin() && $user->isNot($admin);
    }
}
