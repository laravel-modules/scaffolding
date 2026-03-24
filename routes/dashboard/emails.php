<?php

use App\Http\Controllers\Dashboard\SendBatchEmailsController;

Route::post('emails/patch', SendBatchEmailsController::class)->name('emails.patch');
