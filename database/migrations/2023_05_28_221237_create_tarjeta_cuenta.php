<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetaCuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjeta_cuenta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numeroTarjeta', 20);
            $table->date('fechaInicio');
            $table->date('fechaVencimiento');
            $table->string('cvv',4);
            $table->string('nombrePropietario');
            $table->unsignedBigInteger('idMarca');
            $table->foreign('idMarca')->references('id')->on('marca_tarjeta');
            $table->unsignedBigInteger('idTipoTarjeta');
            $table->foreign('idTipoTarjeta')->references('id')->on('tipo_tarjeta');
            $table->unsignedBigInteger('idCuenta');
            $table->foreign('idCuenta')->references('id')->on('cuentas');
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
        Schema::dropIfExists('tarjeta_cuenta');
    }
}
