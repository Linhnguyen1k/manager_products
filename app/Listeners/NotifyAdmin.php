<?php

// app/Listeners/NotifyAdmin.php
namespace App\Listeners;

use App\Events\BookingCreated;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotifyAdmin implements ShouldQueue
{
    public function handle(BookingCreated $event)
    {
        $adminEmail = config('mail.admin_email');
        Log::info('Sending order notification to admin', [
            'order_id' => $event->order->id,
            'admin_email' => $adminEmail,
        ]);

        Notification::route('mail', $adminEmail)
                    ->notify(new NewOrderNotification($event->order));
    }
}
