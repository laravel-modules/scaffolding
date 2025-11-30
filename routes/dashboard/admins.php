<?php

// Admins Routes.
Route::get('trashed/admins', 'AdminController@trashed')
    ->name('admins.trashed');

Route::get('trashed/admins/{trashed_admin}', 'AdminController@showTrashed')
    ->name('admins.trashed.show');

Route::post('admins/{trashed_admin}/restore', 'AdminController@restore')
    ->name('admins.restore');

Route::delete('admins/{trashed_admin}/forceDelete', 'AdminController@forceDelete')
    ->name('admins.forceDelete');

Route::resource('admins', 'AdminController');
