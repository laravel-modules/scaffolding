<?php

namespace Tests\Feature\Dashboard\User;

use App\Models\User;
use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCreate extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_user_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('users.actions.create'));
    }

    /** @test */
    public function it_can_create_users()
    {
        $this->be(factory(Admin::class)->create());

        $usersCount = Admin::count();

        $response = $this->post(route('dashboard.users.store'), [
            'name' => 'User',
            'email' => 'user@demo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'type' => User::ADMIN_TYPE,
        ]);

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $usersCount + 1);
    }
}
