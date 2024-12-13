<?php

namespace App\Listeners;

use App\Events\ConfirmationEmailRequested;
use App\Mail\confirmMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmail
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
    public function handle(ConfirmationEmailRequested $event)
    {
        //
        Mail::to($event->email)->send(new confirmMail("Order payed"));

    }
}
