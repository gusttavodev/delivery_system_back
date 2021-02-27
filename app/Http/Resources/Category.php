<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            // 'photo' => $this->photo,
            'photo' =>   Storage::url($this->photo),
            'priority' => $this->priority,
            'enable' => $this->enable,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
