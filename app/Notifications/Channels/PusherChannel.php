<?php

namespace App\Notifications\Channels;

use Illuminate\Support\Arr;
use Illuminate\Notifications\Notification;
use Pusher\PushNotifications\PushNotifications;

class PusherChannel
{
    /**
     * Send the given notification.
     *
     * @param $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification, 'toPusher')) {
            throw new \Exception('method "toPusher" not found in "'.get_class($notification).'"');
        }

        $data = $notification->toPusher($notifiable) + ['click_action' => 'NotificationData'];

        $this->getPushNotifications()
            ->publishToUsers($this->getInterests($notifiable, $notifiable), [
                "fcm" => [
                    "notification" => $data,
                    "data" => $data,
                ],
                "apns" => [
                    "aps" => [
                        "alert" => $data,
                        "sound" => 'default',
                    ],
                ],
            ]);
    }

    /**
     * Get the interests of the notification.
     *
     * @param $notifiable
     * @param $notification
     * @return \Illuminate\Support\Collection|mixed|string[]
     */
    protected function getInterests($notifiable, $notification)
    {
        $interests = collect(Arr::wrap($notifiable->routeNotificationFor('PusherNotification')))
            ->map(function ($interest) {
                return (string) $interest;
            })->toArray();

        return method_exists($notification, 'pusherInterests')
            ? $notification->pusherInterests($notifiable)
            : ($interests ?: ["{$notifiable->id}"]);
    }

    /**
     * Create PushNotification instance.
     *
     * @throws \Exception
     * @return \Pusher\PushNotifications\PushNotifications
     */
    protected function getPushNotifications(): PushNotifications
    {
        $config = config('services.pusher');

        return new PushNotifications([
            'instanceId' => $config['beams_instance_id'],
            'secretKey' => $config['beams_secret_key'],
        ]);
    }
}
