<?php

namespace Tests\Feature\Settings\Dashboard;

use Tests\TestCase;
use Laraeast\LaravelSettings\Facades\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_settings()
    {
        $this->actingAsAdmin();

        $this->assertFalse(Settings::locale()->has('about'));

        $this->patch(route('dashboard.settings.update'), [
            'about:ar' => 'من نحن',
            'about:en' => 'about',
        ]);

        $this->assertTrue(Settings::locale()->has('about'));
        $this->assertEquals(Settings::locale('en')->get('about'), 'about');
    }
}