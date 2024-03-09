<?php

// Customers Routes.
Route::get('trashed/customers', 'CustomerController@trashed')
    ->name('customers.trashed');

Route::get('trashed/customers/{trashed_customer}', 'CustomerController@showTrashed')
    ->name('customers.trashed.show');

Route::post('customers/{trashed_customer}/restore', 'CustomerController@restore')
    ->name('customers.restore');

Route::delete('customers/{trashed_customer}/forceDelete', 'CustomerController@forceDelete')
    ->name('customers.forceDelete');

Route::resource('customers', 'CustomerController');