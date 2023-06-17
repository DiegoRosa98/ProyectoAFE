<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacciones extends Model
{
    use HasFactory;
    // table name
    protected $table = "transacciones";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['numeroCuentaOrigen', 'numeroCuentaDestino', 'monto', 'descripcion', 'correoNotificacion', 'idCuentaOrigen', 'idCuentaDestino', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all Transactions' list
     */
    public function getTransactions() {
        return Transacciones::all();
    }

    /**
     * Method for retrieving an especific Transaction
     */
    public function getTransactionById($id) {
        return Transacciones::find($id);
    }

    public function getTransactionsByCuentaOrigen($idCO){
        return Transacciones::where('idCuentaOrigen', $idCO)->orWhere('idCuentaDestino', $idCO)->get();
    }

    public function ultimaIDTransaccion()
    {
        return Transacciones::latest()->first()->id;
    }

}
