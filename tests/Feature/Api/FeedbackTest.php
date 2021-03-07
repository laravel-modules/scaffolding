<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Feedback;
use App\Events\FeedbackSent;
use Illuminate\Support\Facades\Event;

class FeedbackTest extends TestCase
{
    /** @test */
    public function anyone_can_send_feedback_message()
    {
        Event::fake();

        $feedbackCount = Feedback::count();

        $this->postJson(route('api.feedback.send'), [
            'name' => 'User',
            'email' => 'user@demo.com',
            'phone' => '123456',
            'message' => 'something ...',
        ]);

        Event::assertDispatched(FeedbackSent::class);

        $this->assertEquals(Feedback::count(), $feedbackCount + 1);
    }
}
