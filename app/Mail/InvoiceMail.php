<?php

// app/Mail/InvoiceMail.php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $pdfPath;

    public function __construct(Order $order, $pdfPath)
    {
        $this->order = $order;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Your Invoice')
                    ->view('emails.invoice')
                    ->attach(Storage::path($this->pdfPath), [
                        'as' => 'invoice-' . $this->order->id . '.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}