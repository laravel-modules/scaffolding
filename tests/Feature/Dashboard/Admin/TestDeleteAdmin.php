<?php

namespace Tests\Feature\Dashboard\Admin;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestDeleteAdmin extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_admin()
    {
        $this->be(factory(Admin::class)->create());

        $admin = factory(Admin::class)->create();

        $adminsCount = Admin::count();

        $response = $this->delete(route('dashboard.admins.destroy', $admin));

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $adminsCount - 1);
    }
}
