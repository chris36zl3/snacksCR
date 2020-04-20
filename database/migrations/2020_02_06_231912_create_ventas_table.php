<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('precioTotal')->nullable();
            $table->boolean('cancelado');
            $table->integer('cantidad');
            $table->integer('user_id')->unsigned();
            $table->integer('producto_id')->unsigned();;
            $table->foreign('user_id')->
            references('id')->
            on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ventas');
    }
}
