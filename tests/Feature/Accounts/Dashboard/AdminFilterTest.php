<?php

namespace Tests\Feature\Accounts\Dashboard;

use Tests\TestCase;
use App\Models\Admin;

class AdminFilterTest extends TestCase
{
    /** @test */
    public function it_can_filter_admins_by_name()
    {
        $this->actingAsAdmin();

        Admin::factory()->create(['name' => 'Ahmed']);

        Admin::factory()->create(['name' => 'Mohamed']);

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

        Admin::factory()->create([
            'name' => 'FooBar1',
            'email' => 'user1@demo.com',
        ]);

        Admin::factory()->create([
            'name' => 'FooBar2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.admins.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }

    /** @test */
    public function it_can_filter_admins_by_phone()
    {
        $this->actingAsAdmin();

        Admin::factory()->create([
            'name' => 'FooBar1',
            'phone' => '123',
        ]);

        Admin::factory()->create([
            'name' => 'FooBar2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.admins.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }
}
