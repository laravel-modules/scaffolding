<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Create a new notification instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->data['via'] ?? [];
    }

    /**
     * The pusher instance for the notifiable.
     *
     * @param $notifiable
     * @return string[]
     */
    public function pusherInterests($notifiable)
    {
        return [(string) $notifiable->id];
    }

    /**
     * Get the pusher representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toPusher($notifiable)
    {
        $data = $this->data['fcm'] ?? [];

        return array_merge($data, [
            'notification_id' => $this->id,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $data = $this->data['database'] ?? [];

        return array_merge($data, [
            'notification_id' => $this->id,
        ]);
    }
}
