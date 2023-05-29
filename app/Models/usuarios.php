<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    // table name
    protected $table = "usuarios";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['correo', 'username', 'idRol', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id', 'clave'];

    /**
     * Method for retrieving all users' list
     */
    public function getUsers() {
        return Usuarios::all();
    }

    /**
     * Method for retrieving an especific user
     */
    public function getUserById($id) {
        return Usuarios::find($id);
    }

}
