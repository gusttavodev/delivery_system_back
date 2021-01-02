<?php

namespace App\Models;

use App\Models\StepOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadmapStep extends Model
{
    use HasFactory;
    protected $table = 'roadmap_steps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'title', 'order', 'has_options', 'message_after_options', 'message_before_options',
        'message_invalid_response', 'step_before_invalid_response', 'roadmap_id'
    ];

    public function options()
    {
        return $this->hasMany(StepOption::class);
    }
}
