<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ucs extends Model
{
    public function test() {
        return $this->belongsTo('App\Test');
    }

    public function ucs_details() {
        return $this->hasMany('App\UcsDetail');
    }
}
