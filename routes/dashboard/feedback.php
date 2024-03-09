<?php

// Feedback Routes.
Route::get('trashed/feedback', 'FeedbackController@trashed')
    ->name('feedback.trashed');

Route::get('trashed/feedback/{trashed_feedback}', 'FeedbackController@showTrashed')
    ->name('feedback.trashed.show');

Route::post('feedback/{trashed_feedback}/restore', 'FeedbackController@restore')
    ->name('feedback.restore');

Route::delete('feedback/{trashed_feedback}/forceDelete', 'FeedbackController@forceDelete')
    ->name('feedback.forceDelete');

Route::patch('feedback/read', 'FeedbackController@read')
    ->name('feedback.read');

Route::patch('feedback/unread', 'FeedbackController@unread')
    ->name('feedback.unread');

Route::resource('feedback', 'FeedbackController')
    ->only('index', 'show', 'destroy');