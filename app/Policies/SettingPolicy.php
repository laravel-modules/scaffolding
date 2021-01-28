<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage settings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function manage(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.settings');
    }
}
