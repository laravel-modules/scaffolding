<?php

namespace App\Notifications\Accounts;

use App\Models\ResetPasswordCode;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class SendForgetPasswordCodeNotification extends Notification
{
    use Queueable;

    /**
     * @var string|int
     */
    private $code;

    /**
     * Create a new notification instance.
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(trans('auth.emails.forget-password.greeting', [
                'user' => $notifiable->name,
            ]))
            ->subject(trans('auth.emails.forget-password.subject'))
            ->line(trans('auth.emails.forget-password.line', [
                'code' => $this->code,
                'minutes' => ResetPasswordCode::EXPIRE_DURATION / 60,
            ]))
            ->line(trans('auth.emails.forget-password.footer'))
            ->salutation(trans('auth.emails.forget-password.salutation', [
                'app' => Config::get('app.name'),
            ]));
    }
}
