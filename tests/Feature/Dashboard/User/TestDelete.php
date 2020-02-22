<?php

namespace Tests\Feature\Dashboard\User;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestDelete extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_user()
    {
        $this->be(factory(Admin::class)->create());

        $user = factory(Admin::class)->create();

        $usersCount = Admin::count();

        $response = $this->delete(route('dashboard.users.destroy', $user));

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $usersCount - 1);
    }
}
