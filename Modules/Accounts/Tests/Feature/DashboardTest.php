<?php

namespace Modules\Accounts\Tests\Feature;

use Tests\TestCase;
use Modules\Accounts\Entities\User;
use Modules\Accounts\Entities\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_users()
    {
        $this->be($user = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.index'));

        $response->assertSuccessful();

        $response->assertSee(e($user->name));
    }

    /** @test */
    public function it_can_display_user_details()
    {
        $this->be($user = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.show', $user));

        $response->assertSuccessful();

        $response->assertSee(e($user->name));
    }

    /** @test */
    public function it_can_display_user_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('accounts::users.actions.create'));
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

    /** @test */
    public function it_can_display_user_edit_form()
    {
        $this->be($user = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.users.edit', $user));

        $response->assertSuccessful();

        $response->assertSee(trans('accounts::users.actions.edit'));
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

    /** @test */
    public function it_can_delete_user()
    {
        $this->be($auth = factory(Admin::class)->create());

        $user = factory(Admin::class)->create();

        $usersCount = Admin::count();

        $response = $this->delete(route('dashboard.users.destroy', $auth));

        $response->assertForbidden();

        $this->assertEquals(Admin::count(), $usersCount);

        $response = $this->delete(route('dashboard.users.destroy', $user));

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $usersCount - 1);
    }
}
