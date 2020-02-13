<?php

namespace Tests\Feature\Dashboard\Admin;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestDisplayAdmin extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_admins()
    {
        $this->be($admin = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.admins.index'));

        $response->assertSuccessful();

        $response->assertSee(e($admin->name));
    }

    /** @test */
    public function it_can_display_admin_details()
    {
        $this->be($admin = factory(Admin::class)->create());

        $response = $this->get(route('dashboard.admins.show', $admin));

        $response->assertSuccessful();

        $response->assertSee(e($admin->name));
    }
}
