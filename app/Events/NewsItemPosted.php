<?php

namespace App\Events;

use App\Events\Event;
use App\News;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewsItemPosted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $news;

    /**
     * Create a new event instance.
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
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
