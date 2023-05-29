<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoServicio extends Model
{
    use HasFactory;
    // table name
    protected $table = "pago_servicio";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['numeroRecibo', 'monto', 'idTipoServicio', 'idTransaccion', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all services Payments list
     */
    public function getServicesPayment() {
        return PagoServicio::all();
    }

    /**
     * Method for retrieving an especific services Payments
     */
    public function getServicesPaymentById($id) {
        return PagoServicio::find($id);
    }
}
