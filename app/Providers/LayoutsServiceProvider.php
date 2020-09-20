<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class LayoutsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load Dashboard Layout.
        $this->loadViewsFrom(
            resource_path('/views/layouts/'. Config::get('layouts.dashboard')),
            'dashboard'
        );

        // Load Frontend Layout.
        $this->loadViewsFrom(
            resource_path('/views/layouts/'. Config::get('layouts.frontend')),
            'frontend'
        );
    }
}
