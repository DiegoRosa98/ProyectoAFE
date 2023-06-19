<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\ViewCuentas;
use App\Models\Perfiles;

class UsuariosController extends Controller
{

    protected $usuarios;
    protected $cuentas;
    protected $perfil;

    public function __construct(Usuarios $usuarios, ViewCuentas $cuenta, Perfiles $perfil)
    {
        $this->usuarios = $usuarios;
        $this->cuentas = $cuenta;
        $this->perfil = $perfil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = $this->usuarios->getUsers();
        return view('users.list', ['users' => $usuarios]);
    }

    public function client()
    {
        $cuenta = $this->cuentas->getAccountByUser();
        $perfil = $this->perfil->getPerfilByUser();
        return view('home-client', ['cuenta' => $cuenta, 'perfil' => $perfil]);
    }

    public function admin()
    {
        $cuenta = $this->cuentas->getAccountByUser();
        $perfil = $this->perfil->getPerfilByUser();
        return view('home-admin', ['cuenta' => $cuenta, 'perfil' => $perfil]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin()
    {
        return view('registro');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuarios($request->all());
        $usuario->clave = hash('sha256', $request->post('clave'));
        $usuario->save();
        return redirect()->action([UsuariosController::class, 'index'])->with('message', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = $this->usuarios->getUserById($id);
        return view('users.edit', ['users' => $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuarios = Usuarios::find($id);
        if($usuarios->count() > 0){
            Usuarios::where('id', $id)->update(array('correo' => $request->correo, 'idRol' => $request->idRol));
        }
        return redirect()->action([UsuariosController::class, 'index'])->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuarios::find($id);
        if($usuarios->count() > 0){
            Usuarios::where('id', $id)->update(array('estado' => 0));
        }
        return redirect()->action([UsuariosController::class, 'index'])->with('message', 'Deleted successfully.');
    }

    //Inicio de sesión
    public function login(Request $request)
    {
        $nombre = $request->post('username');
        $contra = hash('sha256', $request->post('userPassword'));
        $usuarios = $this->usuarios->login($nombre, $contra);
        if($usuarios==1)
        {
            return redirect('/admin')->with('respuesta', $usuarios);
        }
        else if($usuarios==2){
            return redirect('/home')->with('respuesta', $usuarios);
        }else
        {
            return redirect('/')->with('message', 'Invalid user credentials');
        }

    }

    //Cerrar sesión
    public function logout($type)
    {
        $expired = 'Session has expired';
        $closed = 'Session closed';
        $this->usuarios->logout();
        return redirect('/')->with('message', $type == 1 ? $expired : $closed);
    }
}
