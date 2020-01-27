<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    public function test() {
        return $this->belongsTo('App\Test');
    }

    public function spt_details() {
        return $this->hasMany('App\SptDetail');
    }
}
