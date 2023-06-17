<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuentas;
use App\Models\ViewCuentas;
use App\Models\Usuarios;

class CuentasController extends Controller
{
    protected $cuentas;
    protected $vcuentas;
    protected $usuarios;

    public function __construct(Cuentas $cuentas, ViewCuentas $vcuentas, Usuarios $usuarios){
        $this->cuentas = $cuentas;
        $this->vcuentas = $vcuentas;
        $this->usuarios = $usuarios;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vcuentas = $this->vcuentas->getAccounts();
        return view('accounts.list', ['cuentas' => $vcuentas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->usuarios->getAllUsers();
        return view('accounts.create', ['users' => $users]);
    }

    public function crear()
    {
        return view('nueva-cuenta');
    }

    public function crear()
    {
        return view('nueva-cuenta');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo($request);
        $cuentas = new Cuentas($request->all());
        $cuentas->save();
        return redirect()->action([CuentasController::class, 'index'])->with('message', 'Created successfully.');
    }

    public function guardar(Request $request)
    {
        echo($request);
        $cuentas = new Cuentas($request->all());
        $cuentas->save();
        return redirect()->action([CuentasController::class, 'ver'])->with('message', 'Created successfully.');
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

    public function ver()
    {
        $vcuentas = $this->vcuentas->getAccountByUser();
        return view('/cuentas', ['cuentas' => $vcuentas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentas = $this->vcuentas->getAccountsById($id);
        return view('accounts.edit', ['cuentas' => $cuentas]);
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
        $cuentas = Cuentas::find($id);
        $cuentas->fill($request->all());
        $cuentas->save();
        return redirect()->action([CuentasController::class, 'index'])->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuentas = Cuentas::find($id);
        if($cuentas->count() > 0){
            Cuentas::where('id', $id)->update(array('estado' => 0));
        }
        return redirect()->action([CuentasController::class, 'index'])->with('message', 'Deleted successfully.');
    }

    public function delete($id)
    {
        $cuentas = Cuentas::find($id);
        if($cuentas->count() > 0){
            Cuentas::where('id', $id)->update(array('estado' => 0));
        }
        return redirect()->action([CuentasController::class, 'ver'])->with('message', 'Deleted successfully.');
    }
}
