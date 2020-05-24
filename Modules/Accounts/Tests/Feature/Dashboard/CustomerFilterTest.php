<?php

namespace Modules\Accounts\Tests\Feature\Dashboard;

use Tests\TestCase;
use Modules\Accounts\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_customers_by_name()
    {
        $this->actingAsAdmin();

        factory(Customer::class)->create(['name' => 'Ahmed']);

        factory(Customer::class)->create(['name' => 'Mohamed']);

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

        factory(Customer::class)->create([
            'name' => 'User 1',
            'email' => 'user1@demo.com',
        ]);

        factory(Customer::class)->create([
            'name' => 'User 2',
            'email' => 'user2@demo.com',
        ]);

        $this->get(route('dashboard.customers.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }

    /** @test */
    public function it_can_filter_customers_by_phone()
    {
        $this->actingAsAdmin();

        factory(Customer::class)->create([
            'name' => 'User 1',
            'phone' => '123',
        ]);

        factory(Customer::class)->create([
            'name' => 'User 2',
            'email' => '456',
        ]);

        $this->get(route('dashboard.customers.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }
}
