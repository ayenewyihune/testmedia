<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SptDetail extends Model
{
    public function spt() {
        return $this->belongsTo('App\Spt');
    }
}
