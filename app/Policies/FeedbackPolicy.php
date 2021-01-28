<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        return $user->isAdmin() || $user->hasPermissionTo('manage.feedback');
    }
}
