<?php

namespace App\Events;

use App\Models\Verification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerificationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Verification $verification;

    /**
     * Create a new event instance.
     */
    public function __construct(Verification $verification)
    {
        //
        $this->verification = $verification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
