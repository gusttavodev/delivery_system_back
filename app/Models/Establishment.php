<?php

namespace App\Models;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function theme()
    {
        return $this->belongsTo(Theme::class);
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
