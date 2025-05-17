<?php

// app/Listeners/SendOrderConfirmationEmail.php
namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\OrderConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    public function handle(BookingCreated $event)
    {
        Mail::to($event->order->customer_email)->queue(new OrderConfirmation($event->order));
    }
}