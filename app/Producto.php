<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=['codigo','nombre', 'descripcion', 'precio', 'cantidad'];

  public function detallefactura() {
  return $this->belongsTo('App\DetalleFactura');
  }

  public function venta()
  {
      return $this->hasMany('App\Venta');
  }

}
