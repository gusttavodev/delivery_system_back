<?php

namespace App\Models;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'primary_color', 'secondary_color', 'text_color', 'title_text_color',
        'title_text_hover_color', 'background_color', 'button_background_color',
        'button_hover_color', 'button_text_color', 'button_count_color',
        'card_background_color', 'card_text_color', 'card_price_color',
        'user_id'
    ];

    public function establishment()
    {
        return $this->hasOne(Establishment::class);
    }
}
