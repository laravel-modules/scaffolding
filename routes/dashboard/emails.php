<?php

use App\Emails\Http\Controllers\SendBatchEmailsController;

Route::post('emails/patch', SendBatchEmailsController::class)->name('emails.patch');
