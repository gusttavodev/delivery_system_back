<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Address as AddressResource;

class Establishment extends JsonResource
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
            'public_link_name' => $this->public_link_name,
            'name' => $this->name,
            'description' => $this->description,
            'phone' => $this->phone,
            'picture' => $this->picture,
            'background_picture' => $this->background_picture,
            'delivery_time' => $this->delivery_time,
            'min_value' => $this->min_value,

            'address' => new  AddressResource($this->address),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
