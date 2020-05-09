<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Category, Wholesale, Sale};

class Product extends Model
{
    protected $fillable = ['name', 'id_wholesale', 'color', 'pattern', 'quantity', 'netto_price', 'brutto_price', 'price_per_piece', 'in_store'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function wholesale() {
        return $this->belongsTo('App\Wholesale');
    }

    public function sales() {
        return $this->morphOne('App\Sale', 'saleable');
    }
}
