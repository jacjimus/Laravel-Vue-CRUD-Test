<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rooms extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        return [
        'room_name' => $this->room_name,
        'hotel_id' => $this->room_name,
        'hotel_name' => $this->hotel->name,
        'room_type_id' => $this->room_type_id,
        'room_type' => $this->room_type->room_type,
        'room_capacity_id' => $this->room_capacity_id,
        'room_capacity' => $this->room_capacity->room_capacity,
        'room_image' => $this->room_image,
        'status' => $this->status,
            ];
    }
}
