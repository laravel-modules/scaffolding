<?php

namespace Tests\Feature\Dashboard\Admin;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestUpdateAdmin extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_admin_edit_form()
    {
        $this->be($admin = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.admins.edit', $admin));

        $response->assertSuccessful();

        $response->assertSee(trans('admins.actions.edit'));
    }

    /** @test */
    public function it_can_create_admins()
    {
        $this->be($admin = factory(Admin::class)->create());

        $response = $this->put(route('dashboard.admins.update', $admin), [
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();

        $this->assertEquals($admin->refresh()->name, 'Admin');
    }
}
