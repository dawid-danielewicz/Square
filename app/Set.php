<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;

class Set extends Model
{
    public function sales() {
        return $this->morphOne('App\Sale', 'saleable');
    }
}
