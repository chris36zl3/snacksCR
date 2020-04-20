<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable=['nombreCliente','fecha', 'total','descuento'];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function detallefacturas() {
    return $this->belongsTo('App\DetalleFactura');
    }
}
