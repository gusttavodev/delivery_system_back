<?php

namespace App\Models;

use App\Models\RoadmapStep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roadmap extends Model
{
    use HasFactory;
    protected $table = 'roadmaps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'title', 'user_id'
    ];

    public function steps()
    {
        return $this->hasMany(RoadmapStep::class);
    }
}
