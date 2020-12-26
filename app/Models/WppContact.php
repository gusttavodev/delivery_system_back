<?php

namespace App\Models;

use App\Models\User;
use App\Models\WppSession;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WppContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name',
        'server',
        'user_phone',
        '_serialized',
        'user_id',
        'wpp_session_id'
    ];

    /**
     * Get the users record associated with the user.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

     /**
     * Get the session record associated with the user.
     */
    public function session()
    {
        return $this->hasOne(WppSession::class, 'id');
    }
}
