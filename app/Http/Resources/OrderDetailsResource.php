<?php

namespace App\Http\Resources;

use App\Models\Orders;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetails extends JsonResource
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
            'order_id' => $this->order_id,
            'order_number' => Orders::find($this->order_id)->first()->order_number,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at
        ];
    }
}
