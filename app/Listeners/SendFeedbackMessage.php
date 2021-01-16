<?php

namespace App\Listeners;

use App\Events\FeedbackSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  FeedbackSent  $event
     * @return void
     */
    public function handle(FeedbackSent $event)
    {
        //
    }
}
