<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Support\SettingJson;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingTest extends TestCase
{
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
