<?php

namespace App\Listeners;

use App\Events\AccessCanceledEvent;
use App\Mail\CancelAccessMail;
use App\Mail\NotifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AccessCanceledListener
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
    public function handle(AccessCanceledEvent $event): void
    {

        $user = $event->user;

        Mail::to($user->email)->send(new CancelAccessMail($user));
    }
}
