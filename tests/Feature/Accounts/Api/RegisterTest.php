<?php

namespace Tests\Feature\Accounts\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_validation()
    {
        $this->postJson(route('sanctum.register'), [])
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'password']);

        $this->postJson(route('sanctum.register'), [
            'name' => 'User',
            'email' => 'user.demo.com',
            'phone' => '123456',
            'password' => 'password',
            'password_confirmation' => '123456',
        ])
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_register()
    {
        $response = $this->postJson(route('sanctum.register'), [
            'name' => 'User',
            'email' => 'user@demo.com',
            'phone' => '123456',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'data' => ($user = User::all()->last())->getResource()->jsonSerialize(),
            ])
            ->assertJsonStructure(['token']);

        $this->assertEquals($user->name, 'User');
    }
}
