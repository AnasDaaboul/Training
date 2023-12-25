<?php

namespace App\Listeners;

use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPusherMessageListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessageEvent $event): void
    {
        Http::post('https://jsonplaceholder.typicode.com/posts', [
            'id'=>'101',
            'userId' => $event->user->id,
            'title' => $event->message,
            'bode'=>$event->message,
        ]);
    }
}
