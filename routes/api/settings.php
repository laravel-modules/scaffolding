<?php

Route::get('/settings', 'SettingController@index')
    ->name('settings.index');

Route::get('/settings/pages/{page}', 'SettingController@page')
    ->where('page', 'about|terms|privacy')
    ->name('settings.page');
