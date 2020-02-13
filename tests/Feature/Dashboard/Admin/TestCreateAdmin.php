<?php

namespace Tests\Feature\Dashboard\Admin;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCreateAdmin extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_admin_create_form()
    {
        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.admins.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('admins.actions.create'));
    }

    /** @test */
    public function it_can_create_admins()
    {
        $this->be(factory(Admin::class)->create());

        $adminsCount = Admin::count();

        $response = $this->post(route('dashboard.admins.store'), [
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $adminsCount + 1);
    }
}
