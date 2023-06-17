<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacciones;
use App\Models\ViewCuentas;
use App\Models\Cuentas;

class TransaccionesController extends Controller
{
    protected $transacciones;

    public function __construct(Transacciones $transacciones, ViewCuentas $vcuentas, Cuentas $cuentas){
        $this->transacciones = $transacciones;
        $this->vcuentas = $vcuentas;
        $this->cuentas = $cuentas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vcuentas = $this->vcuentas->getAccountByUserTransfer();
        $transfer = $this->transacciones->getTransactionsByCuentaOrigen($vcuentas->id);
        return view('/transferencias', ['transfer' => $transfer, 'miCuenta' => $vcuentas->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/nueva-transferencia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValCuentaDestino = $this->vcuentas->getAccountByNoCuentaDestino($request->post('numeroCuentaDestino'));

        if($ValCuentaDestino != false)
        {
            $cuentaOrigen = $this->vcuentas->getAccountByUserTransfer();

            if(($cuentaOrigen->monto - $request->post('monto')) <= 0.00)
            {
                return redirect('/transferencias')->with('message', 'No puede transferir la cantidad solicitada por saldo insuficiente');
            }
            else
            {
                ///////////////////////////////////////////REGISTRO DE TRANSFERENCIA//////////////////////////////////////////////
                $transacciones = new Transacciones($request->all());
                $transacciones->numeroCuentaOrigen = $cuentaOrigen->numeroCuenta;
                $transacciones->idCuentaOrigen = $cuentaOrigen->id;
                $transacciones->idCuentaDestino = $ValCuentaDestino->id;
                $transacciones->save();
                /////////////////////////////////ACTUALIZAR MONTOS CUENTAS ORIGEN Y DESTINO///////////////////////////////////////
                $montoOrigen = $cuentaOrigen->monto - $request->post('monto');
                $montoDestino = $ValCuentaDestino->monto + $request->post('monto');
                $this->cuentas->actualizarMontos($cuentaOrigen->id, $montoOrigen, $ValCuentaDestino->id, $montoDestino);
                ///////////////////////////////////////////////REDIRECCIONAMIENTO/////////////////////////////////////////////////
                return redirect()->action([TransaccionesController::class, 'index']);
            }

        }
        else
        {
            return redirect('/transferencias')->with('message', 'Cuenta de destino no encontrada');
        }

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
        $transacciones = $this->transacciones->getTransactionById($id);
        return view('transactions/transactions.edit', ['transacciones' => $transacciones]);
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
        $transacciones = Transacciones::find($id);
        $transacciones->fill($request->all());
        $transacciones->save();
        return redirect()->action([TransaccionesController::class, 'index']);
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
}
