<?php

namespace App\Http\Resources;

use App\Models\Products;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderDetails;
class OrdersResource extends JsonResource
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
		    'order_number' => $this->order_number,
		    'details' => OrderDetails::where('order_id' , $this->id)->with('product')->get(),

	    ];
    }
}
