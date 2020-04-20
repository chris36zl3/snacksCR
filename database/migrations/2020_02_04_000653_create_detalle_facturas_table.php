<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->boolean('promo');
            $table->integer('factura_id')->unsigned();
            $table->integer('producto_id')->unsigned();;
            $table->foreign('factura_id')->
            references('id')->
            on('facturas')->onDelete('cascade');
            $table->foreign('producto_id')->
            references('id')->
            on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
}
