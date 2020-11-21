<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name', 'photo', 'priority', 'enable'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
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
