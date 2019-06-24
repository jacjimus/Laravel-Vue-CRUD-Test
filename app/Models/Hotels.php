<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    protected $table = 'hotels';

    public function rooms(){
        return $this->hasMany('App\Models\Rooms');
    }
}
