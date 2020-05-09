<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Wholesale, Sale};

class Accessory extends Model
{
    protected $fillable = ['name', 'quantity', 'brutto_price', 'netto_price', 'price_per_piece', 'in_store'];

    public function wholesale() {
        return $this->belongsTo('App\Wholesale');
    }

    public function sales() {
        return $this->morphOne('App\Sale', 'saleable');
    }
}
