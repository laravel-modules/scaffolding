<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Accounts\Dashboard\AdminController;
use App\Http\Controllers\Accounts\Dashboard\CustomerController;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('locale/{locale}', [LocaleController::class, 'update'])
    ->name('locale')
    ->where('locale', '(ar|en)');

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::prefix('accounts')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('admins', AdminController::class);
});
