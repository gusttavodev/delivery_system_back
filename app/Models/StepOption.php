<?php

namespace App\Models;

use App\Models\Product;
use App\Models\RoadmapStep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StepOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'text', 'order', 'is_product', 'roadmap_step_id'
    ];

    public function step()
    {
        return $this->belongsTo(RoadmapStep::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
