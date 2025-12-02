<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * Generate a QR code image.
     *
     * This method requires the **php-imagick** extension to process and output PNG images.
     * The given value must also end with the `.png` image extension.
     */
    public function image(float $size, string $value): Response
    {
        if (! str($value)->endsWith('.png')) {
            abort(404);
        }

        $value = str($value)->replaceLast('.png', '');

        $png = Cache::rememberForever("{$size}-{$value}-qrcode", function () use ($size, $value) {
            return QrCode::format('png')
                ->size($size)
                ->encoding('UTF-8')
                ->generate($value);
        });

        return response($png)->header('Content-Type', 'image/png');
    }
}
