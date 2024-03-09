<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "dashboard" middleware group and "App\Http\Controllers\Dashboard" namespace.
| and "dashboard." route's alias name. Enjoy building your dashboard!
|
*/

foreach (glob(__DIR__.'/dashboard/*.php') as $routes) {
    include $routes;
}

/*  The routes of generated crud will set here: Don't remove this line  */
