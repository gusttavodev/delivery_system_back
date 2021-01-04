<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    use HasFactory;

    protected $table = 'establishment_opening_hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'start_time', 'name', 'end_time', 'start_day', 'end_day', 'establishment_id'
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
