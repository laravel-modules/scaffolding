<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            if (! $this->hasSoftDeletes($class)) {
                continue;
            }

            Route::bind($key, function ($value) use ($class) {
                return $class::withTrashed()->findOrFail($value);
            });
        }
    }
    /**
     * Determine wither the model use soft deleting trait.
     *
     * @return bool
     */
    public function hasSoftDeletes($class)
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass($class))->getTraits())
        );
    }
}
