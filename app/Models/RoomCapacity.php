<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomCapacity extends Model
{

    use SoftDeletes;
    protected $table = 'room_capacity';

    public function room()
    {
        return $this->hasMany('App\Models\Rooms');
    }
}
