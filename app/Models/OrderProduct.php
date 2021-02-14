<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    /**
     * Get Orders
    */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get additional orders
    */
    public function additional()
    {
        return $this->hasMany(OrderProductAdditional::class);
    }

    /**
     * Get products
    */
    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
