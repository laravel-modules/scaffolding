<?php

namespace App\Notifications\Accounts;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(trans('auth.emails.reset-password.greeting', [
                'user' => $notifiable->name,
            ]))
            ->subject(trans('auth.emails.reset-password.subject'))
            ->line(trans('auth.emails.reset-password.line'))
            ->line(trans('auth.emails.reset-password.footer'))
            ->salutation(trans('auth.emails.reset-password.salutation', [
                'app' => Config::get('app.name'),
            ]));
    }
}
