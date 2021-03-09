<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SoftDeletesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $mapping = json_decode(file_get_contents(storage_path('soft_deletes_route_binding.json')), true);

        foreach ($mapping as $key => $class) {
            Route::bind($key, function ($value) use ($class) {
                return $class::withTrashed()->findOrFail($value);
            });
        }

    }
}
