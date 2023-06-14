<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numeroCuenta', 255);
            $table->float('monto', 8, 2);
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('usuarios');
            $table->unsignedBigInteger('idTipoCuenta');
            $table->foreign('idTipoCuenta')->references('id')->on('tipo_cuenta');
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
        Schema::dropIfExists('cuentas');
    }
}
