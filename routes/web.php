<?php
// routes/web.php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/invoices/:id', [OrderController::class, 'viewInvoice'])->name('invoices.view'); // Thêm route này// Tạo file test-mail.php trong routes/
Route::get('/test-mail', function () {
    \Illuminate\Support\Facades\Mail::raw('Test email', function ($message) {
        $message->to('admin@example.com')->subject('Test Email');
    });
    return 'Email sent';
});