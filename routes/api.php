<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/register', 'Accounts\Api\RegisterController@register')->name('sanctum.register');
Route::post('/login', 'Accounts\Api\LoginController@login')->name('sanctum.login');
Route::post('/firebase/login', 'Accounts\Api\LoginController@firebase')->name('sanctum.login.firebase');

Route::post('/password/forget', 'Accounts\Api\ResetPasswordController@forget')->name('api.password.forget');
Route::post('/password/code', 'Accounts\Api\ResetPasswordController@code')->name('api.password.code');
Route::post('/password/reset', 'Accounts\Api\ResetPasswordController@reset')->name('api.password.reset');
Route::get('/select/users', 'Accounts\SelectController@index')->name('users.select');

Route::middleware('auth:sanctum')->group(
    function () {
        Route::post('verification/send', 'Accounts\Api\VerificationController@send')->name('api.verification.send');
        Route::post('verification/verify', 'Accounts\Api\VerificationController@verify')->name('api.verification.verify');
        Route::get('profile', 'Accounts\Api\ProfileController@show')->name('api.profile.show');
        Route::match(['put', 'patch'], 'profile', 'Accounts\Api\ProfileController@update')
            ->name('api.profile.update');
    }
);
Route::post('/editor/upload', 'MediaController@editorUpload')->name('api.editor.upload');
Route::get('/settings', 'Settings\Api\SettingController@index')->name('api.settings.index');
Route::get('/settings/pages/{page}', 'Settings\Api\SettingController@page')
    ->where('page', 'about|terms|privacy')
    ->name('api.settings.page');

/*  The routes of generated crud will set here: Don't remove this line  */
