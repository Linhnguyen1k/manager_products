<?php

// app/Notifications/NewOrderNotification.php
namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Order Received')
                    ->line('A new order has been placed!')
                    ->line('Order ID: ' . $this->order->id)
                    ->line('Product: ' . $this->order->product->name)
                    ->line('Total: $' . $this->order->total_price);
    }
}