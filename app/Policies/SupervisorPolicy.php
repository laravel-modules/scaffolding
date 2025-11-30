<?php

namespace App\Policies;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;

class SupervisorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any supervisors.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can view the supervisor.
     *
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin()
            || $user->is($supervisor)
            || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can create supervisors.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can update the supervisor.
     *
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        return (
            $user->isAdmin()
            || $user->is($supervisor)
            || $user->hasPermissionTo('manage.supervisors')
        )
            && ! $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can update the type of the supervisor.
     *
     * @return mixed
     */
    public function updateType(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin()
            && $user->isNot($supervisor)
            || $user->hasPermissionTo('manage.supervisors');
    }

    /**
     * Determine whether the user can delete the supervisor.
     *
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        return (
            $user->isAdmin()
            && $user->isNot($supervisor)
            || $user->hasPermissionTo('manage.supervisors')
        )
            && ! $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can view trashed supervisors.
     *
     * @return mixed
     */
    public function viewAnyTrash(User $user)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.supervisors')
        )
            && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can view trashed supervisor.
     *
     * @return mixed
     */
    public function viewTrash(User $user, Supervisor $supervisor)
    {
        return $this->view($user, $supervisor) && $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return mixed
     */
    public function restore(User $user, Supervisor $supervisor)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.supervisors')
        )
            && $this->trashed($supervisor);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Supervisor $supervisor)
    {
        return (
            $user->isAdmin()
            && $user->isNot($supervisor)
            || $user->hasPermissionTo('manage.supervisors')
        )
            && $this->trashed($supervisor)
            && Settings::get('delete_forever');
    }

    /**
     * Determine wither the given supervisor is trashed.
     *
     * @return bool
     */
    public function trashed($supervisor)
    {
        return $this->hasSoftDeletes()
            && method_exists($supervisor, 'trashed')
            && $supervisor->trashed();
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
