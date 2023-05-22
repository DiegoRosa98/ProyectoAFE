<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numeroCuentaOrigen', 255);
            $table->string('numeroCuentaDestino', 255);
            $table->float('monto', 8, 2);
            $table->string('descripcion', 255);
            $table->string('correoNotificacion', 255);
            $table->unsignedBigInteger('idCuentaOrigen');
            $table->foreign('idCuentaOrigen')->references('id')->on('cuentas');
            $table->unsignedBigInteger('idCuentaDestino');
            $table->foreign('idCuentaDestino')->references('id')->on('cuentas');
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
        Schema::dropIfExists('transacciones');
    }
}
