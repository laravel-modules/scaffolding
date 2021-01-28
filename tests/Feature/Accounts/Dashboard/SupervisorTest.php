<?php

namespace Tests\Feature\Accounts\Dashboard;

use Tests\TestCase;
use App\Models\Supervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupervisorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_supervisors()
    {
        $this->actingAsAdmin();

        Supervisor::factory()->create(['name' => 'Ahmed']);

        $response = $this->get(route('dashboard.supervisors.index'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_display_supervisor_details()
    {
        $this->actingAsAdmin();

        $supervisor = Supervisor::factory()->create(['name' => 'Ahmed']);

        $response = $this->get(route('dashboard.supervisors.show', $supervisor));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_display_supervisor_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.supervisors.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('supervisors.actions.create'));
    }

    /** @test */
    public function it_can_create_supervisors()
    {
        $this->actingAsAdmin();

        $supervisorsCount = Supervisor::count();

        $response = $this->postJson(
            route('dashboard.supervisors.store'),
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@demo.com',
                'phone' => '123456789',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertRedirect();

        $this->assertEquals(Supervisor::count(), $supervisorsCount + 1);
    }

    /** @test */
    public function it_can_display_supervisor_edit_form()
    {
        $this->actingAsAdmin();

        $supervisor = Supervisor::factory()->create();

        $response = $this->get(route('dashboard.supervisors.edit', $supervisor));

        $response->assertSuccessful();

        $response->assertSee(trans('supervisors.actions.edit'));
    }

    /** @test */
    public function it_can_update_supervisors()
    {
        $this->actingAsAdmin();

        $supervisor = Supervisor::factory()->create();

        $response = $this->put(
            route('dashboard.supervisors.update', $supervisor),
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@demo.com',
                'phone' => '123456789',
                'password' => 'password',
                'password_confirmation' => 'password',
            ]
        );

        $response->assertRedirect();

        $supervisor->refresh();

        $this->assertEquals($supervisor->name, 'Supervisor');
    }

    /** @test */
    public function it_can_delete_supervisor()
    {
        $this->actingAsAdmin();

        $supervisor = Supervisor::factory()->create();

        $supervisorsCount = Supervisor::count();

        $response = $this->delete(route('dashboard.supervisors.destroy', $supervisor));
        $response->assertRedirect();

        $this->assertEquals(Supervisor::count(), $supervisorsCount - 1);
    }
}
