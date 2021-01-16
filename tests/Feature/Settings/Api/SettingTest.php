<?php

namespace Tests\Feature\Settings\Api;

use Tests\TestCase;
use Laraeast\LaravelSettings\Facades\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_api()
    {
        $this->app->setLocale('en');

        Settings::locale('en')->set('name', 'App Name');

        $response = $this->getJson(route('api.settings.index'));

        $this->assertEquals($response->json('app.name'), 'App Name');
    }
}
