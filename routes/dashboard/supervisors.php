<?php

// Supervisors Routes.
Route::get('trashed/supervisors', 'SupervisorController@trashed')
    ->name('supervisors.trashed');

Route::get('trashed/supervisors/{trashed_supervisor}', 'SupervisorController@showTrashed')
    ->name('supervisors.trashed.show');

Route::post('supervisors/{trashed_supervisor}/restore', 'SupervisorController@restore')
    ->name('supervisors.restore');

Route::delete('supervisors/{trashed_supervisor}/forceDelete', 'SupervisorController@forceDelete')
    ->name('supervisors.forceDelete');

Route::resource('supervisors', 'SupervisorController');
