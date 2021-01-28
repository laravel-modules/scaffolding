<?php

namespace Tests\Feature\Accounts\Dashboard;

use Tests\TestCase;
use App\Models\Supervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupervisorFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_supervisors_by_name()
    {
        $this->actingAsAdmin();

        Supervisor::factory()->create(['name' => 'Ahmed']);

        Supervisor::factory()->create(['name' => 'Mohamed']);

        $this->get(route('dashboard.supervisors.index', [
            'name' => 'ahmed',
        ]))
            ->assertSuccessful()
            ->assertSee('Ahmed')
            ->assertDontSee('Mohamed');
    }

    /** @test */
    public function it_can_filter_supervisors_by_email()
    {
        $this->actingAsAdmin();

        Supervisor::factory()->create([
            'name' => 'FooBar1',
            'email' => 'user1@demo.com',
        ]);

        Supervisor::factory()->create([
            'name' => 'FooBar2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.supervisors.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }

    /** @test */
    public function it_can_filter_supervisors_by_phone()
    {
        $this->actingAsAdmin();

        Supervisor::factory()->create([
            'name' => 'FooBar1',
            'phone' => '123',
        ]);

        Supervisor::factory()->create([
            'name' => 'FooBar2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.supervisors.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }
}
