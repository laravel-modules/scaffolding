<?php

Route::get('notifications/count', 'NotificationController@count')
    ->name('notifications.count');

Route::middleware('auth:sanctum')
    ->get('notifications', 'NotificationController@index')
    ->name('notifications.index');