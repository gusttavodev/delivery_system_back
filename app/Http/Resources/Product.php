<?php

namespace App\Http\Resources;

use App\Http\Resources\Additional as AdditionalResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;

class Product extends JsonResource
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
            'photo' => $this->photo,
            'priority' => $this->priority,
            'enable' => $this->enable,
            'price' => $this->price,
            'description' => $this->description,

            'categories' => CategoryResource::collection($this->categories),
            'additionals' => AdditionalResource::collection($this->additionals),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
