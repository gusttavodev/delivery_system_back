<?php

namespace App\Listeners;

use App\Events\WppSessionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

class WppSessionNotification implements ShouldQueue
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

    // public $connection = 'redis';
    // public $queue = 'wpp_session';
    // public $delay = 60;

    /**
     * Handle the event.
     *
     * @param  WppSessionEvent  $event
     * @return void
     */
    public function handle(WppSessionEvent $event)
    {
        Log::debug('Update Wpp Session '.$event->wppSession->name);
    }

     /**
     * Handle a job failure.
     *
     * @param  \App\Events\WppSessionEvent  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(WppSessionEvent $event, $exception)
    {
        Log::debug('WppSessionEvent Exception '.$Exception);
    }
}
