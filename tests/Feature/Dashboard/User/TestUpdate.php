<?php

namespace Tests\Feature\Dashboard\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestUpdate extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_user_edit_form()
    {
        $this->be($user = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.edit', $user));

        $response->assertSuccessful();

        $response->assertSee(trans('users.actions.edit'));
    }

    /** @test */
    public function it_can_update_users()
    {
        $this->be($user = factory(Admin::class)->create());

        $response = $this->put(route('dashboard.users.update', $user), [
            'name' => 'User',
            'email' => 'user@demo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'type' => User::SUPERVISOR_TYPE,
        ]);

        $response->assertRedirect();

        $user->refresh();

        $user = factory(Admin::class)->create();

        $response = $this->put(route('dashboard.users.update', $user), [
            'name' => 'User',
            'email' => 'other@demo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'type' => User::SUPERVISOR_TYPE,
        ]);

        $response->assertRedirect();

        $user->refresh();

        $this->assertEquals($user->name, 'User');
        $this->assertEquals($user->type, User::SUPERVISOR_TYPE);
    }
}
