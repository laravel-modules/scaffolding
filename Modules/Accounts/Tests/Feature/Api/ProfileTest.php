<?php

namespace Modules\Accounts\Tests\Feature\Api;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Modules\Accounts\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_to_authenticated_user_can_display_his_profile()
    {
        /** @var \Modules\Accounts\Entities\User $user */
        $user = factory(User::class)->create();

        $this->getJson(route('api.profile.show'))
            ->assertStatus(401);

        Sanctum::actingAs($user, ['*']);

        $this->getJson(route('api.profile.show'))
            ->assertSuccessful()
            ->assertJson([
                'data' => $user->getResource()->jsonSerialize(),
            ]);
    }

    /** @test */
    public function only_to_authenticated_user_can_update_his_profile()
    {
        /** @var \Modules\Accounts\Entities\User $user */
        $user = factory(User::class)->create([
            'name' => 'Ahmed',
            'email' => 'ahmed@demo.com',
            'phone' => '123456789',
        ]);

        $this->putJson(route('api.profile.update'))
            ->assertStatus(401);

        Sanctum::actingAs($user, ['*']);

        // test validation
        $this->putJson(route('api.profile.update'), [
            'name' => null,
            'email' => null,
            'phone' => null,
            'password' => 'password',
        ])
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'old_password', 'password']);

        $this->putJson(route('api.profile.update'), [
            'name' => 'Mohamed',
            'email' => 'mohamed@demo.com',
            'phone' => '12345678',
        ])->assertSuccessful()
            ->assertJson([
                'data' => $user->refresh()->getResource()->jsonSerialize(),
            ]);
    }
}
