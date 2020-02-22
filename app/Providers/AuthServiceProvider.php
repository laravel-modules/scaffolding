<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::guessPolicyNamesUsing(function ($modelClass) {
            if (in_array($modelClass, [
                \App\Models\User::class,
                \App\Models\Admin::class,
                \App\Models\Supervisor::class,
            ])) {
                return \App\Policies\UserPolicy::class;
            }

            return 'App\Policies\\'.class_basename($modelClass).'Policy';
        });
    }
}
