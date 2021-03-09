<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any supervisors.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can view the supervisor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() || $user->is($supervisor) || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can create supervisors.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can update the supervisor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        return (($user->isAdmin() || $user->is($supervisor)) || $user->hasPermissionTo('manage.supervisors')) && ! $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can update the type of the supervisor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function updateType(User $user, Supervisor $supervisor)
    {
        return ($user->isAdmin() || $user->is($supervisor)) || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can delete the supervisor.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        return ($user->isAdmin() && $user->isNot($supervisor) || $user->hasPermissionTo('manage.supervisors')) && ! $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can view trashed supervisors.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewTrash(User $user)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.supervisors')) && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function restore(User $user, Supervisor $supervisor)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.supervisors')) && $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Supervisor $supervisor
     * @return mixed
     */
    public function forceDelete(User $user, Supervisor $supervisor)
    {
        return ($user->isAdmin() && $user->isNot($supervisor) || $user->hasPermissionTo('manage.supervisors')) && $this->trashed($supervisor);
    }

    /**
     * Determine wither the given supervisor is trashed.
     *
     * @param $supervisor
     * @return bool
     */
    public function trashed($supervisor)
    {
        return $this->hasSoftDeletes() && method_exists($supervisor, 'trashed') && $supervisor->trashed();
    }

    /**
     * Determine wither the model use soft deleting trait.
     *
     * @return bool
     */
    public function hasSoftDeletes()
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass(Supervisor::class))->getTraits())
        );
    }
}
