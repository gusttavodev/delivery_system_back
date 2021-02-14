<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product as ProductResource;
class CategoryWithProducts extends JsonResource
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
            'products' => ProductResource::collection($this->products),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
