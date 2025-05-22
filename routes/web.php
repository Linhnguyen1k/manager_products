<?php
// routes/web.php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/invoices/:id', [OrderController::class, 'viewInvoice'])->name('invoices.view'); 
Route::get('/test-mail', function () {
    \Illuminate\Support\Facades\Mail::raw('Test email', function ($message) {
        $message->to('admin@example.com')->subject('Test Email');
    });
    return 'Email sent';
});
Route::get('/redis-test', function () {
    Cache::put('x', [1,2,3], 60);
    return Cache::get('x');
});
Route::get('/test-queue', function () {
    Queue::push(function ($job) {
        Log::info('Test job!');
        $job->delete();
    });
    return 'Job pushed!';
});

