<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    protected $table = 'room_types';

    public function room()
    {
        return $this->hasMany('App\Models\Rooms');
    }
}
