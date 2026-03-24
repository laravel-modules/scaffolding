<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LocaleController;

Route::get('locale/{locale}', [LocaleController::class, 'update'])->name('locale')->where('locale', '(ar|en)');

Route::get('/', [DashboardController::class, 'index'])->name('home');
