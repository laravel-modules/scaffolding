<?php

use App\Http\Controllers\Api\SettingController;

Route::get('/settings', [SettingController::class, 'index'])
    ->name('settings.index');

Route::get('/settings/pages/{page}', [SettingController::class, 'page'])
    ->where('page', 'about|terms|privacy')
    ->name('settings.page');
