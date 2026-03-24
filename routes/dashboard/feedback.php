<?php

// Feedback Routes.
use App\Http\Controllers\Dashboard\FeedbackController;

Route::get('trashed/feedback', [FeedbackController::class, 'trashed'])
    ->name('feedback.trashed');

Route::get('trashed/feedback/{trashed_feedback}', [FeedbackController::class, 'showTrashed'])
    ->name('feedback.trashed.show');

Route::post('feedback/{trashed_feedback}/restore', [FeedbackController::class, 'restore'])
    ->name('feedback.restore');

Route::delete('feedback/{trashed_feedback}/forceDelete', [FeedbackController::class, 'forceDelete'])
    ->name('feedback.forceDelete');

Route::patch('feedback/read', [FeedbackController::class, 'read'])
    ->name('feedback.read');

Route::patch('feedback/unread', [FeedbackController::class, 'unread'])
    ->name('feedback.unread');

Route::resource('feedback', FeedbackController::class)
    ->only('index', 'show', 'destroy');
