<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'public_link_name', 'name', 'description', 'phone', 'picture',
        'background_picture', 'delivery_time','complement', 'min_value',
        'address_id', 'user_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
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
