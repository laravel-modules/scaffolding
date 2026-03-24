<?php

use App\Http\Controllers\Api\UserController;

Route::get('/select/users', [UserController::class, 'select'])->name('users.select');
