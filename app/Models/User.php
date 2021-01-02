<?php

namespace App\Models;

use App\Models\Roadmap;

use App\Models\WppContact;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the phone record associated with the User Categories.
    */
    public function categories(){
        return $this->HasMany(Category::class);
    }

    /**
     * Get the phone record associated with the User Products.
    */
    public function products(){
        return $this->HasMany(Product::class);
    }

    /**
     * Get the phone record associated with the Wpp Contact.
    */
    public function wppContact()
    {
        return $this->hasMany(WppContact::class, 'user_id');
    }

    /**
     * Get the user Roadmaps.
    */
    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class, 'user_id');
    }
}
