<?php

namespace App\Models;

use Parental\HasParent;
use App\Http\Resources\AdminResource;
use App\Http\Filters\Accounts\AdminFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory, HasParent;

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = AdminFilter::class;

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
     * @return \App\Http\Resources\AdminResource
     */
    public function getResource()
    {
        return new AdminResource($this);
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return route('dashboard.admins.show', $this);
    }
}
