<?php

namespace App\Listeners;

use App\Events\ProductPurchaseEvent;
use App\Mail\NotifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class ProductPurchaseListener implements ShouldQueue
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
    public function handle(ProductPurchaseEvent $event): void
    {
        $email = $event->email;
        $user = $event->user;
        $product = $event->product;
        Mail::to($email)->send(new NotifyMail($user,$email, $product));

    }
}
