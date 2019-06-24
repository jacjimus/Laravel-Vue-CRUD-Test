<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Roomcpacity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'room_capacity' => $this->room_capacity,
            'status' => $this->status
        ];
    }
}
