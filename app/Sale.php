<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function saleable() {
        return $this->morphTo();
    }
}
