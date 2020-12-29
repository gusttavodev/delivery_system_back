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

//Precisa para disparar no Redis/Canal socket ShouldBroadcast, se não só é escutado com um listener do laravel
class WppSessionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The WppSession instance.
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
     * Get the channels the event should broadcast on. Use in channel()
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('wpp_session_'.$this->wppSession->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return WppSession $this->wppSession
     */
    public function broadcastWith()
    {
       return ['wppSession' => $this->wppSession];
    }

     /**
     * The event's broadcast name. Use in listen()
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'WppSessionEvent';
    }

    /**
	 * Add a Tag to Laravel Horizon
	 */
	public function tags()
	{
		return ['wpp_session', 'wpp_session_' . $this->wppSession->id];
	}
}
