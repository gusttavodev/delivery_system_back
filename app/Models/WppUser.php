<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WppUser extends Model
{
    use HasFactory;

    /**
     * Get the user establishments.
    */
    public function orders()
    {
        return $this->hasMany(Order::class, 'wpp_user_id');
    }
}
