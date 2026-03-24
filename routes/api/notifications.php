<?php

use App\Http\Controllers\Api\NotificationController;

Route::get('notifications/count', [NotificationController::class, 'count'])
    ->name('notifications.count');

Route::middleware('auth:sanctum')
    ->get('notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');
