<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{

    protected $usuarios;

    public function __construct(Usuarios $usuarios)
    {
        $this->usuarios = $usuarios;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registro');
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
        return redirect()->action([UsuariosController::class, 'index']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            return redirect()->action([UsuariosController::class, 'index']);
        }

    }

    //Cerrar sesión
    public function logout()
    {
        $this->usuarios->logout();
        return redirect()->action([UsuariosController::class, 'index']);
    }
}
