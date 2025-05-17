<?php

// app/Console/Commands/DailyOrderReport.php
namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyOrderReportMail;

class DailyOrderReport extends Command
{
    protected $signature = 'report:daily-orders';
    protected $description = 'Send daily order report to admins';

    public function handle()
    {
        $orders = Order::whereDate('created_at', now()->toDateString())->get();
        $total = $orders->sum('total_price');

        Mail::to(config('mail.admin_email'))->send(new DailyOrderReportMail($orders, $total));
        $this->info('Daily order report sent successfully');
    }
}
