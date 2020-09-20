<?php

namespace App\Models;

use Parental\HasParent;
use App\Http\Resources\CustomerResource;
use App\Models\Relations\CustomerRelations;
use App\Http\Filters\Accounts\CustomerFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends User
{
    use HasFactory, HasParent, CustomerRelations;

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = CustomerFilter::class;

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
}
