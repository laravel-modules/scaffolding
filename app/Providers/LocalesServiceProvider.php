<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelLocales\Facades\Locales;

class LocalesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Config::set([
            'translatable.locales' => Locales::codes(),
        ]);
    }
}
