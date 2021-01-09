<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Additional extends Model
{
    use HasFactory;

    public function additionals()
    {
        return $this->belongsToMany(Product::class, 'product_additionals');
    }

    static function findByUser($id, $user_id) {
        $response = self::where('id', $id)->where('user_id', $user_id)->first();
        if(isset($response)){
            return $response;
        }else {
            abort(404);
        }
    }
}
