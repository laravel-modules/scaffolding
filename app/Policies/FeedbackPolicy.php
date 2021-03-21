<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laraeast\LaravelSettings\Facades\Settings;

class FeedbackPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any feedback.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.feedback');
    }

    /**
     * Determine whether the user can view the feedback.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Feedback $feedback
     * @return mixed
     */
    public function view(User $user, Feedback $feedback)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.feedback');
    }

    /**
     * Determine whether the user can create feedback.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the feedback.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Feedback $feedback
     * @return mixed
     */
    public function update(User $user, Feedback $feedback)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the feedback.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Feedback $feedback
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
     * @param \App\Models\User $user
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
     * @param \App\Models\User $user
     * @param \App\Models\Feedback $feedback
     * @return mixed
     */
    public function viewTrash(User $user, Feedback $feedback)
    {
        return $this->view($user, $feedback) && $this->trashed($feedback);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Feedback $feedback
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
     * @param \App\Models\User $user
     * @param \App\Models\Feedback $feedback
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
     * @param $feedback
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
