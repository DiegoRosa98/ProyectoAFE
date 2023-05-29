<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagoServicio;

class PagoServicioController extends Controller
{
    protected $pagoServicio;

    public function __construct(PagoServicio $pagoServicio){
        $this->pagoServicio = $pagoServicio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagoServicio = $this->pagoServicio->getServicesPayment();
        return view('services-payment/services-payment.list', ['pagoServicio' => $pagoServicio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services-payment/services-payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagoServicio = new PagoServicio($request->all());
        $pagoServicio->save();
        return redirect()->action([PagoServicioController::class, 'index']);
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
