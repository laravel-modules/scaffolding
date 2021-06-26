<?php

namespace App\Listeners;

use App\Events\FeedbackSent;
use App\Models\Admin;
use App\Models\NotificationModel;
use App\Notifications\Channels\PusherChannel;
use App\Notifications\CustomNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Laraeast\LaravelSettings\Facades\Settings;

class SendFeedbackMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param FeedbackSent $event
     * @return void
     */
    public function handle(FeedbackSent $event)
    {
        Admin::each(function (Admin $admin) use ($event) {
            Notification::send($admin, new CustomNotification([
                'via' => [
                    'database',
                    //PusherChannel::class,
                ],
                'database' => [
                    'trans' => 'notifications.new-feedback',
                    'feedback_id' => $event->feedback->id,
                    'type' => NotificationModel::FEEDBACK_TYPE,
                ],
                //'fcm' => [
                //    'title' => config('app.name'),
                //    'body' => trans('notifications.new-feedback', [
                //        'user' => $event->feedback->name,
                //    ]),
                //    'type' => NotificationModel::FEEDBACK_TYPE,
                //    'data' => [
                //        'id' => $event->feedback->id,
                //    ],
                //],
            ]));
        });
    }
}
