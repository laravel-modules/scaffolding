<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Feedback;
use Laravel\Sanctum\Sanctum;
use App\Models\NotificationModel;
use App\Notifications\CustomNotification;
use Illuminate\Support\Facades\Notification;

class NotificationTest extends TestCase
{
    /** @test */
    public function only_authenticated_user_can_list_his_notifications()
    {
        $admin = Admin::factory()->create();

        Sanctum::actingAs($admin, ['*']);

        Notification::send($admin, new CustomNotification([
            'via' => [
                'database',
            ],
            'database' => [
                'trans' => 'notifications.new-feedback',
                'feedback_id' => ($feedback = Feedback::factory()->create())->id,
                'type' => NotificationModel::FEEDBACK_TYPE,
            ],
        ]));

        $notification = $admin->notifications()->first();

        $response = $this->getJson(route('api.notifications.index'));

        $response->assertSuccessful();

        $this->assertEquals(
            $response->json('data.0.title'),
            $feedback->getNotificationTitle($notification)
        );
    }

    /** @test */
    public function test_notifications_count()
    {
        $admin = Admin::factory()->create();

        Sanctum::actingAs($admin, ['*']);

        Notification::send($admin, new CustomNotification([
            'via' => [
                'database',
            ],
            'database' => [
                'trans' => 'notifications.new-feedback',
                'feedback_id' => ($feedback = Feedback::factory()->create())->id,
                'type' => NotificationModel::FEEDBACK_TYPE,
            ],
        ]));

        $response = $this->getJson(route('api.notifications.count'))->assertSuccessful();

        $this->assertEquals(1, $response->json('notifications_count'));

        $this->getJson(route('api.notifications.index'));

        $response = $this->getJson(route('api.notifications.count'))->assertSuccessful();

        $this->assertEquals(0, $response->json('notifications_count'));
    }
}
