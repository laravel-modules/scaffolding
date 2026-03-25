<?php

Route::middleware('dashboard.locales')->group(function () {
    // Auth::routes();
});

//Route::redirect('/home', '/dashboard');

Route::impersonate();

//Route::get('/', function () {
//    return view('welcome');
//});

Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        foreach (glob(__DIR__.'/localization/*.php') as $routes) {
            include $routes;
        }
    });
