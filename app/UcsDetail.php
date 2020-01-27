<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UcsDetail extends Model
{
    public function ucs() {
        return $this->belongsTo('App\Ucs');
    }
}
