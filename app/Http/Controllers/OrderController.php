<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_email' => 'required|email',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total_price = $product->getCurrentPrice() * $request->quantity;

        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'customer_email' => $request->customer_email,
        ]);

        return redirect()->route('products.index')->with('success', 'Order placed successfully');
    }

    public function viewInvoice($id)
    {
        $path = 'invoices/invoice-' . $id . '.pdf';
        if (!Storage::exists($path)) {
            abort(404, 'Invoice not found');
        }

        return response()->file(Storage::path($path));
    }
}
