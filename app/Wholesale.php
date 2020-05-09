<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Product, Accessory};

class Wholesale extends Model
{
    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function accessories() {
        return $this->hasMany('App\Accessory');
    }
}
