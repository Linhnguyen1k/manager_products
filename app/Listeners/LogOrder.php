<?php

// app/Listeners/LogOrder.php
namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\LogOrderActivity;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogOrder implements ShouldQueue
{
    public function handle(BookingCreated $event)
    {
        LogOrderActivity::dispatch($event->order);
    }
}
