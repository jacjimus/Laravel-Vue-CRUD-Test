<?php

namespace App\Http\Resources;

use App\Models\RoomTypes;
use Illuminate\Http\Resources\Json\JsonResource;

class Prices extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'cost' =>  $this->cost,
            'room_type_id' => $this->room_type_id,
            'room_type' => RoomTypes::find($this->room_type_id)->first()->room_type,
            'hotel_id' => $this->hotel_id,
            'hotel_name' => $this->hotel->name,
            'season_id' => $this->season_id,
            'season' => $this->season->name,
            'created_at' => $this->created_at
        ];
    }
}
