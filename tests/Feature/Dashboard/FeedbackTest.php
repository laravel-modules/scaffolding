<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Feedback;

class FeedbackTest extends TestCase
{
    /** @test */
    public function it_can_display_a_list_of_feedback_messages()
    {
        $this->actingAsAdmin();

        Feedback::factory()->create(['name' => 'User']);

        $response = $this->get(route('dashboard.feedback.index'));

        $response->assertSuccessful();

        $response->assertSee('User');
    }

    /** @test */
    public function it_can_display_the_feedback_details()
    {
        $this->actingAsAdmin();

        $feedback = Feedback::factory()->create(['name' => 'User']);

        $response = $this->get(route('dashboard.feedback.show', $feedback));

        $response->assertSuccessful();

        $response->assertSee('User');
    }

    /** @test */
    public function it_can_mark_the_feedback_as_read()
    {
        $this->actingAsAdmin();

        $feedback = Feedback::factory()->create(['name' => 'User', 'read_at' => null]);

        $this->assertFalse($feedback->read());

        $this->get(route('dashboard.feedback.show', $feedback));

        $this->assertTrue($feedback->refresh()->read());
    }

    /** @test */
    public function it_can_delete_the_feedback()
    {
        $this->actingAsAdmin();

        $feedback = Feedback::factory()->create(['name' => 'User']);

        $feedbackCount = Feedback::count();

        $this->delete(route('dashboard.feedback.destroy', $feedback));

        $this->assertEquals(Feedback::count(), $feedbackCount - 1);
    }

    /** @test */
    public function it_can_mark_the_selected_feedback_as_read()
    {
        $this->actingAsAdmin();

        $feedback = Feedback::factory()->count(3)->create(['read_at' => null]);

        $feedback->each(function (Feedback $feedback) {
            $this->assertFalse($feedback->read());
        });

        $this->patch(route('dashboard.feedback.read'), [
            'items' => $feedback->pluck('id')->toArray(),
        ]);

        $feedback->each(function (Feedback $feedback) {
            $this->assertTrue($feedback->refresh()->read());
        });
    }

    /** @test */
    public function it_can_mark_the_selected_feedback_as_unread()
    {
        $this->actingAsAdmin();

        $feedback = Feedback::factory()->count(3)->create(['read_at' => now()]);

        $feedback->each(function (Feedback $feedback) {
            $this->assertTrue($feedback->read());
        });

        $this->patch(route('dashboard.feedback.unread'), [
            'items' => $feedback->pluck('id')->toArray(),
        ]);

        $feedback->each(function (Feedback $feedback) {
            $this->assertFalse($feedback->refresh()->read());
        });
    }
}
