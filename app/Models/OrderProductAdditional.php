<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductAdditional extends Model
{
    use HasFactory;

    /**
     * Get Product
    */
    public function product()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
