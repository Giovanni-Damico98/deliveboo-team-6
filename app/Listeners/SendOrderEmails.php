<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderReceivedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SendOrderEmails
{
    public function __construct()
    {
        //
    }

    public function handle(OrderCreated $event)
    {
        Log::info('Listener SendOrderEmails eseguito', ['order_id' => $event->order->id]);

        $order = $event->order;
        $customerEmail = $event->customerEmail;

        Log::info('Email del cliente: ' . $customerEmail);
        Mail::to($customerEmail)->send(new OrderConfirmationMail($order));
        Log::info('Email inviata al cliente', ['email' => $customerEmail]);

        $restaurant = $order->restaurant;
        if ($restaurant) {
            $restaurantOwner = $restaurant->user;
            if ($restaurantOwner && $restaurantOwner->email) {
                Log::info('Email del ristoratore: ' . $restaurantOwner->email);
                Mail::to($restaurantOwner->email)->send(new OrderReceivedMail($order));
                Log::info('Email inviata al ristoratore', ['email' => $restaurantOwner->email]);
            } else {
                Log::error('Email del ristoratore non trovata.');
            }
        } else {
            Log::error('Ristorante non trovato per l\'ordine.');
        }
    }
}
