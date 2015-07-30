<?php

namespace App\Events;

use App\Events\Event;
use App\Hooker;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HookerBought extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;

    /**
     * Create a new event instance.
     *
     * @param Hooker $hooker
     */
    public function __construct(Hooker $hooker)
    {
        $this->id = $hooker->id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['test_chanel'];
    }
}
