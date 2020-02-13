<?php

namespace App\Models\Helpers;

use App\Models\User;

trait UserHelpers
{
    /**
     * Determine whether the user is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type == User::ADMIN_TYPE;
    }

    /**
     * Determine whether the user can access dashboard.
     *
     * @return bool
     */
    public function canAccessDashboard()
    {
        return $this->isAdmin();
    }

    /**
     * The user gravatar image.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm';
    }
}
