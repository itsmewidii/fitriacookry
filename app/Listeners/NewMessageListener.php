<?php

namespace App\Listeners;

use App\Events\NewMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageListener
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
    public function handle(NewMessage $event): void
    {
        $receiverId = $event->receiverId;
        $message = $event->message;

        broadcast(new NewPrivateMessageNotification($message))->toOthers();
        broadcast(new NewPrivateMessageNotification($message))->toOthersOn("private-chat.{$receiverId}");
    }
}
