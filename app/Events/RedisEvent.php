<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Message;
use Log;

class RedisEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $status;

    public function __construct(Message $message, $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function broadcastOn()
    {
        return ['chat'];
    }

    public function broadcastAs()
    {
        Log::info($this->status);
        return $this->status;
    }
}
