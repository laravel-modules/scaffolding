<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any feedback.
     *
     * @param  \App\Models\User|null  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.feedback');
    }

    /**
     * Determine whether the user can view the feedback.
     *
     * @param  \App\Models\User|null  $user
     * @return mixed
     */
    public function view(User $user, Feedback $feedback)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.feedback');
    }

    /**
     * Determine whether the user can create feedback.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the feedback.
     *
     * @return mixed
     */
    public function update(User $user, Feedback $feedback)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the feedback.
     *
     * @return mixed
     */
    public function delete(User $user, Feedback $feedback)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.feedback')
        )
            && ! $this->trashed($feedback);
    }

    /**
     * Determine whether the user can view trashed feedback.
     *
     * @return mixed
     */
    public function viewAnyTrash(User $user)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.feedback')
        )
            && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can view trashed feedback.
     *
     * @return mixed
     */
    public function viewTrash(User $user, Feedback $feedback)
    {
        return $this->view($user, $feedback) && $this->trashed($feedback);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return mixed
     */
    public function restore(User $user, Feedback $feedback)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.feedback')
        )
            && $this->trashed($feedback);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Feedback $feedback)
    {
        return (
            $user->isAdmin()
            || $user->hasPermissionTo('manage.feedback')
        )
            && $this->trashed($feedback)
            && Settings::get('delete_forever');
    }

    /**
     * Determine wither the given feedback is trashed.
     *
     * @return bool
     */
    public function trashed($feedback)
    {
        return $this->hasSoftDeletes() && method_exists($feedback, 'trashed') && $feedback->trashed();
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
            array_keys((new \ReflectionClass(Feedback::class))->getTraits())
        );
    }
}
