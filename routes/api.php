<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group and "App\Http\Controllers\Api" namespace.
| and "api." route's alias name. Enjoy building your API!
|
*/

Route::middleware('api')
    ->namespace('App\Http\Controllers\Api')
    ->as('api.')
    ->group(function () {
        foreach (glob(__DIR__.'/api/*.php') as $routes) {
            include $routes;
        }
    });
