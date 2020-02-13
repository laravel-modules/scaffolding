<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_authorization()
    {
        $this->be(factory(User::class)->create());

        $response = $this->get(route('dashboard.home'));

        $response->assertForbidden();

        $this->be(factory(Admin::class)->create());

        $response = $this->get(route('dashboard.home'));

        $response->assertSuccessful();
    }
}
