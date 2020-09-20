<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Set the currently logged in admin for the application.
     *
     * @param null $driver
     * @return \App\Models\Admin
     */
    public function actingAsAdmin($driver = null)
    {
        $admin = Admin::factory()->create();

        $this->be($admin, $driver);

        return $admin;
    }

    /**
     * Set the currently logged in customer for the application.
     *
     * @param null $driver
     * @return \App\Models\Customer
     */
    public function actingAsCustomer($driver = null)
    {
        $customer = Customer::factory()->create();

        $this->be($customer, $driver);

        return $customer;
    }
}
