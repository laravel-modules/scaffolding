<?php

Route::post('/register', 'RegisterController@register')->name('sanctum.register');
Route::post('/login', 'LoginController@login')->name('sanctum.login');

Route::post('/password/forget', 'ResetPasswordController@forget')->name('password.forget');
Route::post('/password/code', 'ResetPasswordController@code')->name('password.code');
Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('password', 'VerificationController@password')->name('password.check');
    Route::post('verification/send', 'VerificationController@send')->name('verification.send');
    Route::post('verification/verify', 'VerificationController@verify')->name('verification.verify');
    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::match(['put', 'patch'], 'profile', 'ProfileController@update')->name('profile.update');
});
