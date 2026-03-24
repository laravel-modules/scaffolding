<?php

namespace App\Models;

use App\Emails\Concerns\HasEmailTemplate;
use App\Emails\Contracts\HasEmailTemplateContract;
use App\Http\Filters\CustomerFilter;
use App\Http\Resources\CustomerResource;
use App\Models\Relations\CustomerRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parental\HasParent;

class Customer extends User implements HasEmailTemplateContract
{
    use CustomerRelations;
    use HasEmailTemplate;
    use HasFactory;
    use HasParent;
    use SoftDeletes;

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
     * @return CustomerResource
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
        return route('dashboard.customers.show', $this);
    }
}
