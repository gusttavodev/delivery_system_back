<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WppContact extends JsonResource
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
            'server' => $this->server,
            'user_phone' => $this->user_phone,
            '_serialized' => $this->_serialized,
            'user' => $this->user,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
