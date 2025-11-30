<?php

namespace Tests\Feature\Api;

use App\Events\FeedbackSent;
use App\Models\Feedback;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function test_anyone_can_send_feedback_message()
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
