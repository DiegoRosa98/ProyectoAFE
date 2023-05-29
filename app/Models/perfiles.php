<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;
    // table name
    protected $table = "perfiles";

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
     * Method for retrieving all profiles' list
     */
    public function getProfiles() {
        return Perfiles::all();
    }

    /**
     * Method for retrieving an especific profile
     */
    public function getProfileById($id) {
        return Perfiles::find($id);
    }
}
