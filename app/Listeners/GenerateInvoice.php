<?php

// app/Listeners/GenerateInvoice.php
namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\GenerateInvoicePdf;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateInvoice implements ShouldQueue
{
    public function handle(BookingCreated $event)
    {
        GenerateInvoicePdf::dispatch($event->order);
    }
}
