<?php

namespace App\Listeners;

use App\Events\VerificationCreated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationCode
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
     * @param VerificationCreated $event
     * @return void
     */
    public function handle(VerificationCreated $event)
    {
        // TODO: Implement SMS service.

        /* @deprecated */
        Storage::disk('public')->append(
            'verification.txt',
            "The verification code for phone number {$event->verification->phone} is {$event->verification->code} generated at ".now()->toDateTimeString()."\n"
        );
    }
}
