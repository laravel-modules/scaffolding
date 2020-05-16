<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'Api\LoginController@login')->name('sanctum.login');
Route::post('/firebase/login', 'Api\LoginController@firebase')->name('sanctum.login.firebase');

Route::post('/register', 'Api\RegisterController@register')->name('sanctum.register');
Route::get('/select/users', 'SelectController@index')->name('users.select');

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('profile', 'Api\ProfileController@show')->name('api.profile.show');
        Route::match(['put', 'patch'], 'profile', 'Api\ProfileController@update')
            ->name('api.profile.update');
    }
);
