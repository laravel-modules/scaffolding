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
     */
    public function boot(): void
    {
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return '\App\Policies\\'.class_basename($modelClass).'Policy';
        });

        Gate::before(function ($user, $ability) {
            if (in_array($ability, config('permission.supported'))) {
                return $user->isAdmin() ? true : null;
            }
        });
    }
}
