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
Route::post('/register', 'Api\RegisterController@register')->name('sanctum.register');
Route::post('/login', 'Api\LoginController@login')->name('sanctum.login');
Route::post('/firebase/login', 'Api\LoginController@firebase')->name('sanctum.login.firebase');

Route::post('/password/forget', 'Api\ResetPasswordController@forget')->name('api.password.forget');
Route::post('/password/code', 'Api\ResetPasswordController@code')->name('api.password.code');
Route::post('/password/reset', 'Api\ResetPasswordController@reset')->name('api.password.reset');
Route::get('/select/users', 'SelectController@index')->name('users.select');

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('profile', 'Api\ProfileController@show')->name('api.profile.show');
        Route::match(['put', 'patch'], 'profile', 'Api\ProfileController@update')
            ->name('api.profile.update');
    }
);
