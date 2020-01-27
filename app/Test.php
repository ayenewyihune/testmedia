<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function instruments() {
        return $this->belongsToMany('App\Instrument');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function testworks() {
        return $this->hasMany('App\Testwork');
    }

    public function direct_shears() {
        return $this->hasMany('App\DirectShear');
    }

    public function ucs() {
        return $this->hasMany('App\Ucs');
    }

    public function spts() {
        return $this->hasMany('App\Spt');
    }
}
