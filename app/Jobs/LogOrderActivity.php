<?php

// app/Jobs/LogOrderActivity.php
namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogOrderActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        Log::info('Order processed', [
            'order_id' => $this->order->id,
            'product_id' => $this->order->product_id,
            'total_price' => $this->order->total_price,
            'status' => $this->order->status,
        ]);
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Failed to log order activity', [
            'order_id' => $this->order->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
