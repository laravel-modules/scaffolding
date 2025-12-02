<?php

use App\Http\Controllers\QrCodeController;

Route::get('qr/{size}/{value}', [QrCodeController::class, 'image'])
    ->where(['size' => '[0-9]+', 'value' => '(.*).png$'])
    ->name('qrcode.image');
