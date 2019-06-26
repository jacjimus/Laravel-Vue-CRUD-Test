<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    protected $table = 'seasons';

    public function prices(){

        return $this->hasMany('App\Models\Prices');
    }
}
