<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model
{
    use HasFactory;
    // table name
    protected $table = "tipo_cuenta";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all AccountTypes' list
     */
    public function getAccountType() {
        return TipoCuenta::all();
    }

    /**
     * Method for retrieving an especific AccountType
     */
    public function getAccountTypeById($id) {
        return TipoCuenta::find($id);
    }
}
