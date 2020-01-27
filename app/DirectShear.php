<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectShear extends Model
{
    public function test() {
        return $this->belongsTo('App\Test');
    }

    public function direct_shear_details() {
        return $this->hasMany('App\DirectShearDetail');
    }
}
