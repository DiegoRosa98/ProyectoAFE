<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCuentas extends Model
{
    use HasFactory;
    // table name
    protected $table = "v_cuentas";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['numeroCuenta', 'monto', 'idUsuario', 'username', 'idTipoCuenta', 'tipoCuenta', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all Accounts' list
     */
    public function getAccounts() {
        return ViewCuentas::where('estado', 1)->paginate(5);
    }

    /**
     * Method for retrieving an especific Account
     */
    public function getAccountsById($id) {
        return ViewCuentas::find($id);
    }

    public function getAccountByUser(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $idUser = $_SESSION['ID'];
        return ViewCuentas::where('idUsuario', $idUser)->get();
    }
}
