<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomTypes extends Model
{
    protected $table = 'room_types';
    use SoftDeletes;

    public function room()
    {
        return $this->hasMany('App\Models\Rooms');
    }

    public function prices(){

        return $this->hasMany('App\Models\Prices');
    }


}
