<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCapacity extends Model
{
    protected $table = 'room_capacity';

    public function room()
    {
        return $this->hasMany('App\Models\Rooms');
    }
}
