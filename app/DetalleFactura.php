<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $fillable=['cantidad','promo'];

    public function factura(){
      return $this->belongsTo('App\Factura');
    }

    public function producto(){
      return $this->belongsTo('App\Producto');
    }
}
