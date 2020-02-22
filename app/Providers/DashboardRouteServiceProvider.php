<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;

class DashboardRouteServiceProvider extends RouteServiceProvider
{
    /**
     * This namespace is applied to your dashboard controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $dashboardNamespace = 'App\Http\Controllers\Dashboard';

    /**
     * This namespace is applied to your dashboard controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $apiNamespace = 'App\Http\Controllers\Api';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        parent::map();

        $this->mapDashboardRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->apiNamespace)
             ->as('api.')
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "dashboard" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDashboardRoutes()
    {
        Route::prefix('dashboard')
             ->middleware(['web', 'auth', 'dashboard'])
             ->namespace($this->dashboardNamespace)
             ->as('dashboard.')
             ->group(base_path('routes/dashboard.php'));
    }
}
