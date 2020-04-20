<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable=['precioTotal', 'cancelado','cantidad'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function producto() {
        return $this->belongsTo('App\Producto');
    }
}
