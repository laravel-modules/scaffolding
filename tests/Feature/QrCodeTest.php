<?php

namespace Tests\Feature;

use Tests\TestCase;

class QrCodeTest extends TestCase
{
    public function test_returns_404_for_non_png_value()
    {
        $response = $this->get(route('qrcode.image', ['size' => 200, 'value' => 'test-value.jpg']));

        $response->assertNotFound();
    }

    public function test_returns_qr_code_image_for_valid_png_value()
    {
        $response = $this->get(route('qrcode.image', ['size' => 200, 'value' => 'test-value.png']));

        $response->assertSuccessful();

        $response->assertHeader('Content-Type', 'image/png');
    }
}
