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
    protected $fillable = ['nombreCompleto', 'edad', 'sexo', 'estadoCivil',  'direccion', 'dui', 'nit', 'idUsuario', 'estado', 'created_at', 'updated_at'];
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

    public function getPerfilByUser(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $idUser = $_SESSION['ID'];
        return Perfiles::where('idUsuario',$idUser)->get();
    }
}
