<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Admin;

class AdminTest extends TestCase
{
    /** @test */
    public function it_can_display_list_of_admins()
    {
        $this->actingAsAdmin();

        Admin::factory()->create(['name' => 'Ahmed']);

        $response = $this->get(route('dashboard.admins.index'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_display_admin_details()
    {
        $this->actingAsAdmin();

        $admin = Admin::factory()->create(['name' => 'Ahmed']);

        $response = $this->get(route('dashboard.admins.show', $admin));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_display_admin_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.admins.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('admins.actions.create'));
    }

    /** @test */
    public function it_can_create_admins()
    {
        $this->actingAsAdmin();

        $adminsCount = Admin::count();

        $response = $this->post(
            route('dashboard.admins.store'),
            Admin::factory()->raw([
                'name' => 'Admin',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
        );

        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $adminsCount + 1);
    }

    /** @test */
    public function it_can_display_admin_edit_form()
    {
        $this->actingAsAdmin();

        $admin = Admin::factory()->create();

        $response = $this->get(route('dashboard.admins.edit', $admin));

        $response->assertSuccessful();

        $response->assertSee(trans('admins.actions.edit'));
    }

    /** @test */
    public function it_can_update_admins()
    {
        $this->actingAsAdmin();

        $admin = Admin::factory()->create();

        $response = $this->put(
            route('dashboard.admins.update', $admin),
            Admin::factory()->raw([
                'name' => 'Admin',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
        );

        $response->assertRedirect();

        $admin->refresh();

        $this->assertEquals($admin->name, 'Admin');
    }

    /** @test */
    public function it_can_delete_admin()
    {
        $this->actingAsAdmin();

        $admin = Admin::factory()->create();

        $adminsCount = Admin::count();

        $response = $this->delete(route('dashboard.admins.destroy', $admin));
        $response->assertRedirect();

        $this->assertEquals(Admin::count(), $adminsCount - 1);
    }

    /** @test */
    public function it_can_display_trashed_admins()
    {
        if (! $this->useSoftDeletes($model = Admin::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        Admin::factory()->create(['deleted_at' => now(), 'name' => 'Ahmed']);

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.admins.trashed'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_display_trashed_admin_details()
    {
        if (! $this->useSoftDeletes($model = Admin::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $admin = Admin::factory()->create(['deleted_at' => now(), 'name' => 'Ahmed']);

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.admins.trashed.show', $admin));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    /** @test */
    public function it_can_restore_deleted_admin()
    {
        if (! $this->useSoftDeletes($model = Admin::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $admin = Admin::factory()->create(['deleted_at' => now()]);

        $this->actingAsAdmin();

        $response = $this->post(route('dashboard.admins.restore', $admin));

        $response->assertRedirect();

        $this->assertNull($admin->refresh()->deleted_at);
    }

    /** @test */
    public function it_can_force_delete_admin()
    {
        if (! $this->useSoftDeletes($model = Admin::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $admin = Admin::factory()->create(['deleted_at' => now()]);

        $this->actingAsAdmin();

        $adminCount = Admin::withTrashed()->count();

        $response = $this->delete(route('dashboard.admins.forceDelete', $admin));

        $response->assertRedirect();

        $this->assertEquals(Admin::withoutTrashed()->count(), $adminCount - 1);
    }

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
