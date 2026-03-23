<?php

use App\Http\Controllers\Dashboard\ExcelController;

Route::get('excel/export', [ExcelController::class, 'export'])->name('excel.export');
Route::post('excel/import', [ExcelController::class, 'import'])->name('excel.import');
