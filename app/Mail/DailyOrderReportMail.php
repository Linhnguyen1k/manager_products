<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyOrderReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $total;

    public function __construct($orders, $total)
    {
        $this->orders = $orders;
        $this->total = $total;
    }

    public function build()
    {
        return $this->subject('Daily Order Report')
                    ->view('emails.daily_order_report');
    }
}
