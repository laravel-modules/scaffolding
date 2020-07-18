<?php

namespace Modules\Accounts\Entities\Observers;

use Modules\Accounts\Entities\User;

class UserObserver
{
    /**
     * Listen to the "creating" event.
     *
     * @param \Modules\Accounts\Entities\User $user
     */
    public function creating(User $user)
    {
        if (! $user->timezone) {
            $user->forceFill([
                'timezone' => $user->getLocalTimezone(),
            ]);
        }
    }
}