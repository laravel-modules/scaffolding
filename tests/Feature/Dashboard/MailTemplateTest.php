<?php

namespace Tests\Feature\Dashboard;

use App\Models\Customer;
use App\Models\MailTemplate;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_display_a_list_of_mail_templates()
    {
        $this->actingAsAdmin();

        MailTemplate::factory()->create(RuleFactory::make(['%name%' => 'Foo']));

        $this->get(route('dashboard.mail-templates.index'))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    public function test_it_can_display_the_mail_template_details()
    {
        $this->actingAsAdmin();

        $mailTemplate = MailTemplate::factory()->create(RuleFactory::make(['%name%' => 'Foo']));

        $this->get(route('dashboard.mail-templates.show', $mailTemplate))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    public function test_it_can_display_mail_templates_create_form()
    {
        $this->actingAsAdmin();

        $this->get(route('dashboard.mail-templates.create'))
            ->assertRedirect();

        $this->get(route('dashboard.mail-templates.create', ['model_type' => Customer::class]))
            ->assertSuccessful();
    }

    public function test_it_can_create_a_new_mail_template()
    {
        $this->actingAsAdmin();

        $mailTemplatesCount = MailTemplate::count();

        $response = $this->post(
            route('dashboard.mail-templates.store', ['model_type' => Customer::class]),
            MailTemplate::factory()->raw(RuleFactory::make([
                '%name%' => 'Foo',
                '%subject%' => 'Test Subject',
                '%content%' => 'Test Content',
            ]))
        );

        $response->assertRedirect();

        $mailTemplate = MailTemplate::all()->last();

        $this->assertEquals(MailTemplate::count(), $mailTemplatesCount + 1);

        $this->assertEquals($mailTemplate->name, 'Foo');
        $this->assertEquals($mailTemplate->subject, 'Test Subject');
        $this->assertEquals($mailTemplate->content, 'Test Content');
    }

    public function test_it_can_display_the_mail_templates_edit_form()
    {
        $this->actingAsAdmin();

        $mailTemplate = MailTemplate::factory()->create();

        $this->get(route('dashboard.mail-templates.edit', $mailTemplate))
            ->assertSuccessful();
    }

    public function test_it_can_update_the_mail_template()
    {
        $this->actingAsAdmin();

        $mailTemplate = MailTemplate::factory()->create();

        $response = $this->put(
            route('dashboard.mail-templates.update', $mailTemplate),
            MailTemplate::factory()->raw(RuleFactory::make([
                '%name%' => 'Foo',
                '%subject%' => 'Test Subject',
                '%content%' => 'Test Content',
            ]))
        );

        $mailTemplate->refresh();

        $response->assertRedirect();

        $this->assertEquals($mailTemplate->name, 'Foo');
        $this->assertEquals($mailTemplate->subject, 'Test Subject');
        $this->assertEquals($mailTemplate->content, 'Test Content');
    }

    public function test_it_can_delete_the_mail_template()
    {
        $this->actingAsAdmin();

        $mailTemplate = MailTemplate::factory()->create();

        $mailTemplatesCount = MailTemplate::count();

        $response = $this->delete(route('dashboard.mail-templates.destroy', $mailTemplate));

        $response->assertRedirect();

        $this->assertEquals(MailTemplate::count(), $mailTemplatesCount - 1);
    }

    public function test_it_can_display_trashed_mail_templates()
    {
        if (! $this->useSoftDeletes($model = MailTemplate::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        MailTemplate::factory()->create(RuleFactory::make(['deleted_at' => now(), '%name%' => 'Ahmed']));

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.mail-templates.trashed'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    public function test_it_can_display_trashed_mail_template_details()
    {
        if (! $this->useSoftDeletes($model = MailTemplate::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $mailTemplate = MailTemplate::factory()->create(RuleFactory::make(['deleted_at' => now(), '%name%' => 'Ahmed']));

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.mail-templates.trashed.show', $mailTemplate));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    public function test_it_can_restore_deleted_mail_template()
    {
        if (! $this->useSoftDeletes($model = MailTemplate::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $mailTemplate = MailTemplate::factory()->create(['deleted_at' => now()]);

        $this->actingAsAdmin();

        $response = $this->post(route('dashboard.mail-templates.restore', $mailTemplate));

        $response->assertRedirect();

        $this->assertNull($mailTemplate->refresh()->deleted_at);
    }

    public function test_it_can_force_delete_mail_template()
    {
        if (! $this->useSoftDeletes($model = MailTemplate::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $mailTemplate = MailTemplate::factory()->create(['deleted_at' => now()]);

        $visitorCount = MailTemplate::withTrashed()->count();

        $this->actingAsAdmin();

        $response = $this->delete(route('dashboard.mail-templates.forceDelete', $mailTemplate));

        $response->assertRedirect();

        $this->assertEquals(MailTemplate::withoutTrashed()->count(), $visitorCount - 1);
    }

    public function test_it_can_filter_mail_templates_by_name()
    {
        $this->actingAsAdmin();

        MailTemplate::factory()->create([
            'name' => 'Foo',
        ]);

        MailTemplate::factory()->create([
            'name' => 'Bar',
        ]);

        $this->get(route('dashboard.mail-templates.index', [
            'name' => 'Fo',
        ]))
            ->assertSuccessful()
            ->assertSee(__('mail-templates.filter'))
            ->assertSee('Foo')
            ->assertDontSee('Bar');
    }
}
