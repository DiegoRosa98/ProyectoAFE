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

    public function login($user, $pass) {
        $usuario = Usuarios::where('username', $user)->where('clave',$pass)->get();
        if($usuario->count() > 0)
        {
            ///////////////////GUARDANDO SESIONES///////////////////
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['ID']=$usuario->first()->id;
            $_SESSION['USER']=$usuario->first()->username;
            $_SESSION['ROL']=$usuario->first()->idRol;
            /////////////////////GENERAR TOKEN//////////////////////
            date_default_timezone_set('America/El_Salvador');
            $token = bin2hex(random_bytes(50));
            $expiracion = date('Y-m-d H:i:s', strtotime('+60 seconds'));
            Usuarios::where('id', $_SESSION['ID'])->update(array('token' => $token, 'expires' => $expiracion));
            $_SESSION['EXPIRES']=$expiracion;
            return 1;
        }
        else
        {
            return 0;
        }
        
    }

    public function logout() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        Usuarios::where('id', $_SESSION['ID'])->update(array('token' => null, 'expires' => null));
        session_destroy();
    }

}
