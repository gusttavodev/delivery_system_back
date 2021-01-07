<?php

namespace App\Http\Resources;

use App\Enums\DaysOfWeek;
use Illuminate\Http\Resources\Json\JsonResource;

class OpeningHours extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $enumData = DaysOfWeek::coerce($this->day)->value;

        return [
            'day' => $this->day,
            'label' => $enumData['label'],
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'not_open' => $this->not_open,
            'start_time_error' => false,
            'end_time_error' => false
        ];
    }

}
