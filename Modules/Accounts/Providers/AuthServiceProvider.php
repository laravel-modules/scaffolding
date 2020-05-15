<?php

namespace Modules\Accounts\Providers;

use Modules\Accounts\Entities\User;
use Modules\Accounts\Entities\Admin;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Policies\UserPolicy;
use Modules\Accounts\Policies\AdminPolicy;
use Modules\Accounts\Policies\CustomerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Admin::class => AdminPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
