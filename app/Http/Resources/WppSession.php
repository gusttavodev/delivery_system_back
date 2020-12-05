<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WppSession extends JsonResource
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
            'status' => $this->status,
            'is_auth' => $this->is_auth,
            'phone' => $this->phone,

            'user_id' => $this->user_id,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
