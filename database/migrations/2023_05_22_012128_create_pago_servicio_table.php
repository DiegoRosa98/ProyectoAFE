<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_servicio', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numeroRecibo', 255);
            $table->float('monto', 8, 2);
            $table->unsignedBigInteger('idTipoServicio');
            $table->foreign('idTipoServicio')->references('id')->on('tipo_servicio');
            $table->unsignedBigInteger('idTransaccion');
            $table->foreign('idTransaccion')->references('id')->on('transacciones');
            $table->integer('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_servicio');
    }
}
