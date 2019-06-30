<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $table = 'room_prices';

    /*
     * room type relations
     */
    public function roomtype()
    {
        return $this->belongsTo('App\Models\RoomTypes');
    }
/*
 * season relation
 */
    public function season(){
        return $this->belongsTo('App\Models\Seasons');
    }
 /*
  * Hotel relation
  */
    public function hotel(){
        return $this->belongsTo('App\Models\Hotels');
    }


}
