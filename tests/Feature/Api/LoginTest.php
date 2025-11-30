<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

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
}
