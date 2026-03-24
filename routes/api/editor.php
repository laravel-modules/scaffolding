<?php

use App\Http\Controllers\Api\MediaController;

Route::post('/editor/upload', [MediaController::class, 'editorUpload'])->name('editor.upload');
