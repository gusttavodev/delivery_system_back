<?php

namespace App\Models;

use App\Models\User;

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
        'user_id'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
