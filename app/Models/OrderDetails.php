<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function product(){
    	return $this->hasOne( Products::class, 'id', 'product_id' );
    }
}
