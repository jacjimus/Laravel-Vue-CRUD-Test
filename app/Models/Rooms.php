<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    protected $table = 'rooms_manager';
    use SoftDeletes;

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotels');
    }

    public function room_type()
    {
        return $this->belongsTo('App\Models\RoomTypes');
    }

    public function room_capacity()
    {
        return $this->belongsTo('App\Models\RoomCapacity');
    }
}
