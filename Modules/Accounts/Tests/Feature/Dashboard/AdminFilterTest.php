<?php

namespace Modules\Accounts\Tests\Feature\Dashboard;

use Tests\TestCase;
use Modules\Accounts\Entities\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_admins_by_name()
    {
        $this->actingAsAdmin();

        factory(Admin::class)->create(['name' => 'Ahmed']);

        factory(Admin::class)->create(['name' => 'Mohamed']);

        $this->get(route('dashboard.admins.index', [
            'name' => 'ahmed',
        ]))
            ->assertSuccessful()
            ->assertSee('Ahmed')
            ->assertDontSee('Mohamed');
    }

    /** @test */
    public function it_can_filter_admins_by_email()
    {
        $this->actingAsAdmin();

        factory(Admin::class)->create([
            'name' => 'User 1',
            'email' => 'user1@demo.com',
        ]);

        factory(Admin::class)->create([
            'name' => 'User 2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.admins.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }

    /** @test */
    public function it_can_filter_admins_by_phone()
    {
        $this->actingAsAdmin();

        factory(Admin::class)->create([
            'name' => 'User 1',
            'phone' => '123',
        ]);

        factory(Admin::class)->create([
            'name' => 'User 2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.admins.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }
}
