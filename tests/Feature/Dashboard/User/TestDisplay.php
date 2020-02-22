<?php

namespace Tests\Feature\Dashboard\User;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestDisplay extends TestCase
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
}
