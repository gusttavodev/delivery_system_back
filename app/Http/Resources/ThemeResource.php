<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'text_color' => $this->text_color,
            'title_text_color' => $this->title_text_color,
            'title_text_hover_color' => $this->title_text_hover_color,
            'background_color' => $this->background_color,

            'button_background_color' => $this->button_background_color,
            'button_hover_color' => $this->button_hover_color,
            'button_text_color' => $this->button_text_color,
            'button_count_color' => $this->button_count_color,

            'card_background_color' => $this->card_background_color,
            'card_text_color' => $this->card_text_color,
            'card_price_color' => $this->card_price_color,
        ];
    }
}
