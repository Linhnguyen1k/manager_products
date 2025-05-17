<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'sale_price', 'sale_start', 'sale_end', 'is_active'
    ];

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isOnSale()
    {
        return $this->is_active && 
               $this->sale_price && 
               $this->sale_start && 
               $this->sale_end && 
               now()->gte($this->sale_start) && 
               now()->lte($this->sale_end);
    }

    public function getCurrentPrice()
    {
        return $this->isOnSale() ? $this->sale_price : $this->price;
    }

    public function getRemainingTime()
    {
        if ($this->isOnSale() && $this->sale_end) {
            $diff = now()->diffInSeconds($this->sale_end);
            return $diff > 0 ? $diff : 0;
        }
        return 0;
    }
}
