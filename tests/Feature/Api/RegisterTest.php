<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use App\Events\VerificationCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class RegisterTest extends TestCase
{
    public function test_customer_register_validation()
    {
        $this->postJson(route('api.sanctum.register'), [])
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'password']);

        $this->postJson(route('api.sanctum.register'), [
            'name' => 'User',
            'email' => 'user.demo.com',
            'phone' => '123456',
            'type' => User::CUSTOMER_TYPE,
            'avatar' => UploadedFile::fake()->create('file.pdf'),
            'password' => 'password',
            'password_confirmation' => '123456',
        ])
            ->assertJsonValidationErrors(['email', 'password', 'avatar']);
    }

    public function test_customer_register()
    {
        Event::fake();

        Storage::fake('avatars');

        $response = $this->postJson(route('api.sanctum.register'), [
            'name' => 'User',
            'email' => 'user@demo.com',
            'phone' => '123456',
            'password' => 'password',
            'type' => User::CUSTOMER_TYPE,
            'password_confirmation' => 'password',
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertSuccessful()
            ->assertJsonStructure(['token']);

        $user = User::all()->last();

        $this->assertEquals($user->name, 'User');

        $this->assertCount(1, $user->getMedia('avatars'));

        Event::assertDispatched(VerificationCreated::class);
    }
}
