<?php

Route::middleware('dashboard.locales')->group(function () {
    // Auth::routes();
});

Route::redirect('/home', '/dashboard');

Route::impersonate();

Route::get('/', function () {
    return view('welcome');
});
