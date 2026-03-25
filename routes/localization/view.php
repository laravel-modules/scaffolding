<?php

use App\Http\Controllers\WebController;

Route::get('{view?}', WebController::class)->name('web.view');
