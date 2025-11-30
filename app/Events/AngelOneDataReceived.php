<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AngelOneDataReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        // Log::info('AngelOneDataReceived', [$this->data]);
    }

    public function broadcastOn()
    {
        return new Channel('angelone-channel');  // Channel to listen on the frontend
    }

    public function broadcastAs()
    {
        return 'angelone.price.update';
    }
}
