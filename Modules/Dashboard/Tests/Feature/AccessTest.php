<?php

namespace Modules\Dashboard\Tests\Feature;

use Tests\TestCase;
use Modules\Accounts\Entities\User;
use Modules\Accounts\Entities\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessTest extends TestCase
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
