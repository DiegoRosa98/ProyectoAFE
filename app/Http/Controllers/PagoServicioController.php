<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagoServicio;
use App\Models\TipoServicio;
use App\Models\Transacciones;
use App\Models\ViewCuentas;
use App\Models\Cuentas;
use App\Models\Perfiles;

class PagoServicioController extends Controller
{
    protected $pagoServicio;

    public function __construct(
        PagoServicio $pagoServicio,
        TipoServicio $tipoServicio,
        Transacciones $transacciones,
        ViewCuentas $vcuentas,
        Cuentas $cuentas,
        Perfiles $pefiles
    ){
        $this->pagoServicio = $pagoServicio;
        $this->tipoServicio = $tipoServicio;
        $this->transacciones = $transacciones;
        $this->vcuentas = $vcuentas;
        $this->cuentas = $cuentas;
        $this->pefiles = $pefiles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoServicio = $this->tipoServicio->getServiciosDisponibles();
        $perfiles = $this->pefiles->getPerfilByUser();
        return view('/servicios', ['servicios' => $tipoServicio, 'perfil' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('/pago-servicios', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoServicio = $this->tipoServicio->getServiceTypeById($request->post('idTipoServicio'));
        ////////////////////////////////////////////////////////////CREAR TRANSACCIÓN////////////////////////////////////////////////////////////
        $ValCuentaDestino = $this->vcuentas->getAccountByNoCuentaDestino('4114');

        if($ValCuentaDestino != false)
        {
            $cuentaOrigen = $this->vcuentas->getAccountByUserTransfer();

            if(($cuentaOrigen->monto - $request->post('monto')) <= 0.00)
            {
                return redirect('/servicios')->with('message', 'No puede transferir la cantidad solicitada por saldo insuficiente');
            }
            else
            {
                ///////////////////////////////////////////REGISTRO DE TRANSFERENCIA//////////////////////////////////////////////
                $transacciones = new Transacciones();
                $transacciones->numeroCuentaOrigen = $cuentaOrigen->numeroCuenta;
                $transacciones->numeroCuentaDestino = '4114';
                $transacciones->monto = $request->post('monto');
                $transacciones->descripcion = 'Deposito para pagar servicio: '.$tipoServicio->nombre;
                $transacciones->correoNotificacion = 'pagos@afe.com';
                $transacciones->idCuentaOrigen = $cuentaOrigen->id;
                $transacciones->idCuentaDestino = $ValCuentaDestino->id;
                $transacciones->estado = 1;
                $transacciones->save();
                /////////////////////////////////ACTUALIZAR MONTOS CUENTAS ORIGEN Y DESTINO///////////////////////////////////////
                $montoOrigen = $cuentaOrigen->monto - $request->post('monto');
                $montoDestino = $ValCuentaDestino->monto + $request->post('monto');
                $this->cuentas->actualizarMontos($cuentaOrigen->id, $montoOrigen, $ValCuentaDestino->id, $montoDestino);
                ////////////////////////////////////////////////////PAGAR SERVICIO////////////////////////////////////////////////
                $pagoServicio = new PagoServicio($request->all());
                $pagoServicio->idTransaccion = $this->transacciones->ultimaIDTransaccion();
                $pagoServicio->save();
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
        $pagoServicio = $this->pagoServicio->getServicesPaymentById($id);
        return view('services-payment/services-payment.edit', ['pagoServicio' => $pagoServicio]);
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
        $pagoServicio = PagoServicio::find($id);
        $pagoServicio->fill($request->all());
        $pagoServicio->save();
        return redirect()->action([PagoServicioController::class, 'index']);
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
