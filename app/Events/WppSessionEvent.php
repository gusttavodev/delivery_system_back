<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\WppSession;

class WppSessionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\WppSession
   */
    public $wppSession;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(WppSession $wppSession)
    {
        $this->wppSession = $wppSession;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('wpp_session_'.$this->wppSession->id);
    }

     /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'WppSession';
    }

    /**
	 * Add a Tag to Laravel Horizon
	 */
	public function tags()
	{
		return ['wpp_ession', 'wpp_ession.' . $this->wppSession->id];
	}
}
