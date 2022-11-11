<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Support\FirebaseToken;

class LoginTest extends TestCase
{
    public function test_login_validation()
    {
        $this->postJson(route('api.sanctum.login'), [])
            ->assertJsonValidationErrors(['username', 'password']);

        $this->postJson(route('api.sanctum.login'), [
            'username' => 'user@demo.com',
            'password' => 'password',
        ])
            ->assertJsonValidationErrors(['username']);
    }

    public function test_sanctum_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('api.sanctum.login'), [
            'username' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'data' => $user->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);

        $response = $this->postJson(route('api.sanctum.login'), [
            'username' => $user->phone,
            'password' => 'password',
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
            $mock->shouldReceive('accessToken')->with('dummy token')->andReturnSelf();
            $mock->shouldReceive('getName')->andReturns('Jane Doe');
            $mock->shouldReceive('getEmail')->andReturns('jane@doe.tld');
            $mock->shouldReceive('getPhoneNumber')->andReturns('+1234567890');
            $mock->shouldReceive('getFirebaseId')->andReturns('W0IturDwy4TYTmX6ilkd2ZbAXRp2');
        });

        // Test validation.
        $this->postJson(route('api.sanctum.login.firebase'))
            ->assertJsonValidationErrors('access_token');

        $this->postJson(route('api.sanctum.login.firebase'), [
            'access_token' => 'dummy token',
        ])
            ->assertSuccessful()
            ->assertJson([
                'data' => ($user = User::all()->last())->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);

        $this->assertEquals($user->phone, '+1234567890');
        $this->assertEquals($user->email, 'jane@doe.tld');
        $this->assertEquals($user->name, 'Jane Doe');
        $this->assertEquals($user->firebase_id, 'W0IturDwy4TYTmX6ilkd2ZbAXRp2');
    }
}
