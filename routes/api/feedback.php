<?php

use App\Http\Controllers\Api\FeedbackController;

Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.send');
