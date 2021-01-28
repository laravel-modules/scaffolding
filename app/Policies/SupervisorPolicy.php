<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any supervisors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the supervisor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supervisor  $supervisor
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() || $user->is($supervisor);
    }

    /**
     * Determine whether the user can create supervisors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the supervisor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supervisor  $supervisor
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() || $user->is($supervisor);
    }

    /**
     * Determine whether the user can update the type of the supervisor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supervisor  $supervisor
     * @return mixed
     */
    public function updateType(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() && $user->isNot($supervisor);
    }

    /**
     * Determine whether the user can delete the supervisor.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Supervisor  $supervisor
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() && $user->isNot($supervisor);
    }
}
