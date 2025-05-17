<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\BookingCreated;

class Order extends Model
{
    protected $fillable = ['product_id', 'quantity', 'total_price', 'customer_email', 'status'];

    protected $dispatchesEvents = [
        'created' => BookingCreated::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}