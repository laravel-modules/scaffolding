<?php

// Admins Routes.
use App\Http\Controllers\Dashboard\AdminController;

Route::get('trashed/admins', [AdminController::class, 'trashed'])
    ->name('admins.trashed');

Route::get('trashed/admins/{trashed_admin}', [AdminController::class, 'showTrashed'])
    ->name('admins.trashed.show');

Route::post('admins/{trashed_admin}/restore', [AdminController::class, 'restore'])
    ->name('admins.restore');

Route::delete('admins/{trashed_admin}/forceDelete', [AdminController::class, 'forceDelete'])
    ->name('admins.forceDelete');

Route::resource('admins', AdminController::class);
