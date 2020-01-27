<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    public function tests() {
        return $this->belongsToMany('App\Test');
    }
}
