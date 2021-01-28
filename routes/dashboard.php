<?php

use Illuminate\Support\Facades\Route;

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
Route::get('locale/{locale}', 'LocaleController@update')
    ->name('locale')
    ->where('locale', '(ar|en)');

Route::get('/', 'DashboardController@index')->name('home');

Route::prefix('accounts')->group(function () {
    Route::delete('delete', 'DeleteController@destroy')->name('delete.selected');
    Route::resource('customers', 'Accounts\Dashboard\CustomerController');
    Route::resource('supervisors', 'Accounts\Dashboard\SupervisorController');
    Route::resource('admins', 'Accounts\Dashboard\AdminController');
});
Route::get('settings', 'Settings\Dashboard\SettingController@index')->name('settings.index');
Route::patch('settings', 'Settings\Dashboard\SettingController@update')->name('settings.update');
Route::get('backup/download', 'Settings\Dashboard\SettingController@downloadBackup')->name('backup.download');
Route::patch('feedback/read', 'Feedback\Dashboard\FeedbackController@read')->name('feedback.read');
Route::patch('feedback/unread', 'Feedback\Dashboard\FeedbackController@unread')->name('feedback.unread');
Route::resource('feedback', 'Feedback\Dashboard\FeedbackController')->only('index', 'show', 'destroy');

/*  The routes of generated crud will set here: Don't remove this line  */
