<?php

namespace Tests\Feature\Accounts\Dashboard;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_customers_by_name()
    {
        $this->actingAsAdmin();

        Customer::factory()->create(['name' => 'Ahmed']);

        Customer::factory()->create(['name' => 'Mohamed']);

        $this->get(route('dashboard.customers.index', [
            'name' => 'ahmed',
        ]))
            ->assertSuccessful()
            ->assertSee('Ahmed')
            ->assertDontSee('Mohamed');
    }

    /** @test */
    public function it_can_filter_customers_by_email()
    {
        $this->actingAsAdmin();

        Customer::factory()->create([
            'name' => 'FooBar1',
            'email' => 'user1@demo.com',
        ]);

        Customer::factory()->create([
            'name' => 'FooBar2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.customers.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }

    /** @test */
    public function it_can_filter_customers_by_phone()
    {
        $this->actingAsAdmin();

        Customer::factory()->create([
            'name' => 'FooBar1',
            'phone' => '123',
        ]);

        Customer::factory()->create([
            'name' => 'FooBar2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.customers.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('FooBar1')
            ->assertDontSee('FooBar2');
    }
}
