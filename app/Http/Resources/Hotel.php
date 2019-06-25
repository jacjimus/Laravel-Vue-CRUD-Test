<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Hotel extends JsonResource
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
            'id' => $this->id,
            'hotel_name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip' => $this->zip,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'image' => $this->image,
            'status' => $this->status
        ];
    }

    public function with($request){
        return [

            'author' => 'James Makau',
            'version' => '1.0'];
    }
}
