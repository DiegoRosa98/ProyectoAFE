<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaCuenta extends Model
{
    use HasFactory;
    // table name
    protected $table = "tarjeta_cuenta";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['numeroTarjeta', 'fechaInicio', 'fechaVencimiento', 'nombrePropietario', 'cvv', 'idMarca', 'idTipoTarjeta', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all Cards' list
     */
    public function getCards() {
        return TarjetaCuenta::all();
    }

    /**
     * Method for retrieving an especific Card
     */
    public function getCardById() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $idUser = $_SESSION['ID'];
        return TarjetaCuenta::where('idUsuario', $idUser)->get();
    }
}
