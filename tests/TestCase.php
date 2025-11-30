<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Supervisor;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laraeast\LaravelSettings\Facades\Settings;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * Set up the test environment.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->seed(RolesAndPermissionsSeeder::class);

        Settings::set('delete_forever', true);
    }

    /**
     * Set the currently logged in admin for the application.
     *
     * @param  null  $driver
     * @return \App\Models\Admin
     */
    public function actingAsAdmin($driver = null)
    {
        $admin = Admin::factory()->create();

        $this->be($admin, $driver);

        return $admin;
    }

    /**
     * Set the currently logged in supervisor for the application.
     *
     * @param  null  $driver
     * @return \App\Models\Supervisor
     */
    public function actingAsSupervisor($driver = null)
    {
        $supervisor = Supervisor::factory()->create();

        $this->be($supervisor, $driver);

        return $supervisor;
    }

    /**
     * Set the currently logged in customer for the application.
     *
     * @param  null  $driver
     * @return \App\Models\Customer
     */
    public function actingAsCustomer($driver = null)
    {
        $customer = Customer::factory()->create();

        $this->be($customer, $driver);

        return $customer;
    }

    /**
     * Determine wither the model use soft deleting trait.
     *
     * @return bool
     */
    public function useSoftDeletes($model)
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass($model))->getTraits())
        );
    }
}
