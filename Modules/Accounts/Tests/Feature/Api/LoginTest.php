<?php

namespace Modules\Accounts\Tests\Feature\Api;

use Tests\TestCase;
use Modules\Accounts\Entities\User;
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
        /** @var \Modules\Accounts\Entities\User $user */
        $user = factory(User::class)->create();

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
}
