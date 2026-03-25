<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        foreach (glob(__DIR__.'/localization/*.php') as $routes) {
            include $routes;
        }
    });



foreach (glob(__DIR__.'/web/*.php') as $routes) {
    include $routes;
}

Route::prefix('dashboard')
    ->middleware('dashboard')
    ->as('dashboard.')
    ->group(function () {
        foreach (glob(__DIR__.'/dashboard/*.php') as $routes) {
            include $routes;
        }
    });
