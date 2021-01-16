<?php

namespace Tests\Feature\Settings\Dashboard;

use Tests\TestCase;
use App\Support\SettingJson;
use Laraeast\LaravelSettings\Facades\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_settings()
    {
        $this->partialMock(SettingJson::class, function ($m) {
            $m->shouldReceive('update');
        });

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
