<?php

namespace App\Emails\Enums;

enum EmailStatus: string
{
    case QUEUED = 'queued';
    case SENDING = 'sending';
    case SENT = 'sent';
    case FAILED = 'failed';

    public function label(): string
    {
        return match($this) {
            self::QUEUED => __('emails.statuses.queued'),
            self::SENDING => __('emails.statuses.sending'),
            self::SENT => __('emails.statuses.sent'),
            self::FAILED => __('emails.statuses.failed'),
        };
    }
}
