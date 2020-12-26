<?php

namespace App\Listeners;

use App\Events\WppSessionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

class WppSessionNotification
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

    public $connection = 'redis';
    public $queue = 'wpp_session';
    public $delay = 60;

    /**
     * Handle the event.
     *
     * @param  WppSessionEvent  $event
     * @return void
     */
    public function handle(WppSessionEvent $data)
    {
        Log::debug('Update Wpp Session '.$data->wppSession->name);
    }
}
