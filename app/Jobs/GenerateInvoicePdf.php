<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\InvoiceMail;
use Spatie\Browsershot\Browsershot;

class GenerateInvoicePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        try {
            $path = 'invoices/invoice-' . $this->order->id . '.pdf';
            // Tạo thư mục nếu chưa tồn tại
            Storage::makeDirectory('invoices');

            Browsershot::html(view('pdfs.invoice', ['order' => $this->order])->render())
                ->save(storage_path('app/' . $path));

            Mail::to($this->order->customer_email)
                ->queue(new InvoiceMail($this->order, $path));
        } catch (\Exception $e) {
            Log::error('Failed to generate PDF or send invoice email', [
                'order_id' => $this->order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
