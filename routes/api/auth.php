<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\VerificationController;

Route::post('/register', [RegisterController::class, 'register'])->name('sanctum.register');
Route::post('/login', [LoginController::class, 'login'])->name('sanctum.login');

Route::post('/password/forget', [ResetPasswordController::class, 'forget'])->name('password.forget');
Route::post('/password/code', [ResetPasswordController::class, 'code'])->name('password.code');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('password', [VerificationController::class, 'password'])->name('password.check');
    Route::post('verification/send', [VerificationController::class, 'send'])->name('verification.send');
    Route::post('verification/verify', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::match(['put', 'patch'], 'profile', [ProfileController::class, 'update'])->name('profile.update');
});
