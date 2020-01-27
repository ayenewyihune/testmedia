<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectShearDetail extends Model
{
    public function direct_shear() {
        return $this->belongsTo('App\DirectShear');
    }
}
