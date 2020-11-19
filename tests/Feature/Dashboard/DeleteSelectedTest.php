<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteSelectedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_multiple_models()
    {
        $this->actingAsAdmin();

        $customers = Customer::factory()->count(10)->create();

        $this->assertEquals(10, $customers->count());

        $response = $this->delete(route('dashboard.delete.selected'), [
            'type' => Customer::class,
            'resources' => trans('customers.plural'),
            'items' => $customers->pluck('id')->toArray(),
        ]);

        $response->assertRedirect();

        $this->assertEquals(0, Customer::count());
    }
}
