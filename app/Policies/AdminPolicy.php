<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any admins.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @return mixed
     */
    public function view(User $user, Admin $admin)
    {
        return $user->isAdmin() || $user->is($admin);
    }

    /**
     * Determine whether the user can create admins.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        return ($user->isAdmin() || $user->is($admin)) && ! $this->trashed($admin);
    }

    /**
     * Determine whether the user can update the type of the admin.
     *
     * @return mixed
     */
    public function updateType(User $user, Admin $admin)
    {
        return $user->isAdmin() && $user->isNot($admin);
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        return ($user->isAdmin() && $user->isNot($admin)) && ! $this->trashed($admin);
    }

    /**
     * Determine whether the user can view trashed admins.
     *
     * @return mixed
     */
    public function viewAnyTrash(User $user)
    {
        return $user->isAdmin() && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can view trashed admin.
     *
     * @return mixed
     */
    public function viewTrash(User $user, Admin $admin)
    {
        return $this->view($user, $admin) && $this->trashed($admin);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return mixed
     */
    public function restore(User $user, Admin $admin)
    {
        return $user->isAdmin() && $this->trashed($admin);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Admin $admin)
    {
        return $user->isAdmin()
            && $user->isNot($admin)
            && $this->trashed($admin)
            && Settings::get('delete_forever');
    }

    /**
     * Determine wither the given admin is trashed.
     *
     * @return bool
     */
    public function trashed($admin)
    {
        return $this->hasSoftDeletes() && method_exists($admin, 'trashed') && $admin->trashed();
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
            array_keys((new \ReflectionClass(Admin::class))->getTraits())
        );
    }
}
