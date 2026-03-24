<?php

namespace Tests\Feature\Api;

use App\Models\MailTemplate;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MailTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_mail_templates()
    {
        $this->actingAsAdmin();

        MailTemplate::factory()->count(2)->create();

        $this->getJson(route('api.mail-templates.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }

    public function test_mail_templates_select2_api()
    {
        MailTemplate::factory()->count(5)->create();

        $response = $this->getJson(route('api.mail-templates.select'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 1);

        $this->assertCount(5, $response->json('data'));

        $response = $this->getJson(route('api.mail-templates.select', ['selected_id' => 4]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 4);

        $this->assertCount(5, $response->json('data'));
    }

    public function test_it_can_display_the_visitor_details()
    {
        $this->actingAsAdmin();

        $MailTemplate = MailTemplate::factory(RuleFactory::make(['%name%' => 'Foo']))->create();

        $response = $this->getJson(route('api.mail-templates.show', $MailTemplate))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertEquals($response->json('data.name'), 'Foo');
    }
}
