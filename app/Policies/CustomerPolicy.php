<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return $user->isAdmin() || $user->is($customer);
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return $user->isAdmin() || $user->is($customer);
    }

    /**
     * Determine whether the user can update the type of the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function updateType(User $user, Customer $customer)
    {
        return $user->isAdmin() && $user->isNot($customer);
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Customer  $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return $user->isAdmin() && $user->isNot($customer);
    }
}
