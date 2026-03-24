<?php

// Customers Routes.
use App\Http\Controllers\Dashboard\CustomerController;

Route::get('trashed/customers', [CustomerController::class, 'trashed'])
    ->name('customers.trashed');

Route::get('trashed/customers/{trashed_customer}', [CustomerController::class, 'showTrashed'])
    ->name('customers.trashed.show');

Route::post('customers/{trashed_customer}/restore', [CustomerController::class, 'restore'])
    ->name('customers.restore');

Route::delete('customers/{trashed_customer}/forceDelete', [CustomerController::class, 'forceDelete'])
    ->name('customers.forceDelete');

Route::resource('customers', CustomerController::class);
