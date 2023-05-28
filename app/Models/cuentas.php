<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuentas extends Model
{
    use HasFactory;
    // table name
    protected $table = "cuentas";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['numeroCuenta', 'idUsuario', 'idTipoCuenta', 'idBanco', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all Accounts' list
     */
    public function getAccounts() {
        return cuentas::all();
    }

    /**
     * Method for retrieving an especific Account
     */
    public function getAccountsById($id) {
        return cuentas::find($id);
    }
}
