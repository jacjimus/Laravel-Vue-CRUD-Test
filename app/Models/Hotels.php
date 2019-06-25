<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hotels extends Model
{

    use SoftDeletes;
    protected $table = 'hotels';

    public function rooms(){
        return $this->hasMany('App\Models\Rooms');
    }
}
