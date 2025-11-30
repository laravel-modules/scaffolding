<?php

namespace App\Models;

use App\Http\Filters\SupervisorFilter;
use App\Http\Resources\CustomerResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parental\HasParent;

class Supervisor extends User
{
    use HasFactory;
    use HasParent;
    use SoftDeletes;

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = SupervisorFilter::class;

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
     * @return \App\Http\Resources\CustomerResource
     */
    public function getResource()
    {
        return new CustomerResource($this);
    }

    /**
     * Get the dashboard profile link.
     */
    public function dashboardProfile(): string
    {
        return route('dashboard.supervisors.show', $this);
    }
}
