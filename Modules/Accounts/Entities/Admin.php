<?php

namespace Modules\Accounts\Entities;

use Parental\HasParent;
use Modules\Accounts\Transformers\AdminResource;

class Admin extends User
{
    use HasParent;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'user_id';
    }

    /**
     * Get the resource for admin type.
     *
     * @return \Modules\Accounts\Transformers\AdminResource
     */
    public function getResource()
    {
        return new AdminResource($this);
    }
}
