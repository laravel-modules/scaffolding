<?php

// Supervisors Routes.
use App\Http\Controllers\Dashboard\SupervisorController;

Route::get('trashed/supervisors', [SupervisorController::class, 'trashed'])
    ->name('supervisors.trashed');

Route::get('trashed/supervisors/{trashed_supervisor}', [SupervisorController::class, 'showTrashed'])
    ->name('supervisors.trashed.show');

Route::post('supervisors/{trashed_supervisor}/restore', [SupervisorController::class, 'restore'])
    ->name('supervisors.restore');

Route::delete('supervisors/{trashed_supervisor}/forceDelete', [SupervisorController::class, 'forceDelete'])
    ->name('supervisors.forceDelete');

Route::resource('supervisors', SupervisorController::class);
