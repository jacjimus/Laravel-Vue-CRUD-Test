<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class Roomtype extends JsonResource
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
            'id' => $this->id,
            'room_type' => $this->room_type,
            'status' => $this->status,
            'created_at' => date('Y, M, d', strtotime($this->created_at)),
        ];
    }
}
