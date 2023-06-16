<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    use HasFactory;
    // table name
    protected $table = "cuentas";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['idUsuario', 'idTipoCuenta', 'idBanco', 'numeroCuenta', 'monto','estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all Accounts' list
     */
    public function getAccounts() {
        return Cuentas::where('estado', 1);
    }

    /**
     * Method for retrieving an especific Account
     */
    public function getAccountsById($id) {
        return Cuentas::find($id);
    }

    public function actualizarMontos($idOrigen, $montoOrigen, $idDestino, $montoDestino)
    {
        Cuentas::where('id', $idOrigen)->update(array('monto' => $montoOrigen));
        Cuentas::where('id', $idDestino)->update(array('monto' => $montoDestino));
    }
    
}
