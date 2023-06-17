<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    use HasFactory;
    // table name
    protected $table = "tipo_servicio";

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
     * Method for retrieving all ServiceTypes' list
     */
    public function getServiceTypes() {
        return TipoServicio::all();
    }

    /**
     * Method for retrieving an especific ServiceType
     */
    public function getServiceTypeById($id) {
        return TipoServicio::find($id);
    }

    public function getServiciosDisponibles()
    {
        return TipoServicio::where('estado', 1)->get();
    }
}
