<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
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
            'zip_code' => $this->zip_code,
            'street' => $this->street,
            'city' => $this->city,
            'country' => $this->country,
            'district' => $this->district,
            'state' => $this->state,
            'number' => $this->number,
            'complement' => $this->complement,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,


            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
