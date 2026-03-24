<?php

// Settings Routes.
use App\Http\Controllers\Dashboard\SettingController;

Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');
Route::patch('settings/env', [SettingController::class, 'env'])->name('settings.env');
Route::get('backup/download', [SettingController::class, 'downloadBackup'])->name('backup.download');
