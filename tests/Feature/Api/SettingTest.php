<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingTest extends TestCase
{
    public function test_settings_api()
    {
        $this->app->setLocale('en');

        Settings::locale('en')->set('name', 'App Name');

        $response = $this->getJson(route('api.settings.index'));

        $this->assertEquals($response->json('app.name'), 'App Name');
    }

    public function test_upload_image_via_editor()
    {
        Storage::fake('public');

        $this->assertFalse(Settings::has('editor'));

        $this->postJson(route('api.editor.upload'), [
            'image' => UploadedFile::fake()->image('photo.jpg'),
        ])->assertSuccessful();

        $this->assertTrue(Settings::has('editor'));

        $this->assertEquals(Settings::instance('editor')->getMedia('editor')->count(), 1);
    }
}
