<?php

namespace Tests\Feature\Accounts\Api;

use Tests\TestCase;
use App\Models\User;
use App\Support\FirebaseToken;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_validation()
    {
        $this->postJson(route('sanctum.login'), [])
            ->assertJsonValidationErrors(['username', 'password']);

        $this->postJson(route('sanctum.login'), [
            'username' => 'user@demo.com',
            'password' => 'password',
        ])
            ->assertJsonValidationErrors(['username']);
    }

    public function test_sanctum_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('sanctum.login'), [
            'username' => $user->email,
            'password' => 'password',
            'device_name' => 'testing',
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'data' => $user->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);

        $response = $this->postJson(route('sanctum.login'), [
            'username' => $user->phone,
            'password' => 'password',
            'device_name' => 'testing',
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'data' => $user->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);
    }

    public function test_firebase_login()
    {
        $this->partialMock(FirebaseToken::class, function ($mock) {
            $mock->shouldReceive('getPhoneNumber')
                ->once()
                ->with('dummy token')
                ->andReturns('123456789');
        });

        // Test validation.
        $this->postJson(route('sanctum.login.firebase'))
            ->assertJsonValidationErrors('access_token');

        $this->postJson(route('sanctum.login.firebase'), [
            'access_token' => 'dummy token',
        ])
            ->assertSuccessful()
            ->assertJson([
                'data' => ($user = User::all()->last())->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);

        $this->assertEquals($user->phone, '123456789');
    }
}
