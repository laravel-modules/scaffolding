<?php

// Select All Routes.
use App\Http\Controllers\Dashboard\DeleteController;

Route::delete('delete', [DeleteController::class, 'destroy'])->name('delete.selected');
Route::delete('forceDelete', [DeleteController::class, 'forceDelete'])->name('forceDelete.selected');
Route::delete('restore', [DeleteController::class, 'restore'])->name('restore.selected');
