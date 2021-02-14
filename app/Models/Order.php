<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'need_change', 'change_price', 'total_price', 'tracking_link', 'user_type', 'user_id',
        'wpp_user_id', 'payment_mode_id', 'status_id'
    ];

    /**
     * Get User Of Order
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get wppUser Of Order
    */
    public function wppUser()
    {
        return $this->belongsTo(WppUser::class);
    }

    /**
     * Get products orders
    */
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Get order payment mode
    */
    public function paymentMode()
    {
        return $this->hasOne(PaymentMode::class);
    }

    /**
     * Get order status
    */
    public function status()
    {
        return $this->hasOne(StatusOrder::class);
    }

    /**
     * Get order payment mode
    */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
