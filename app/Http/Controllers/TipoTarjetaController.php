<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoTarjeta;

class TipoTarjetaController extends Controller
{
    protected $tipoTarjeta;

    public function __construct(TipoTarjeta $tipoTarjeta){
        $this->tipoTarjeta = $tipoTarjeta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoTarjeta = $this->tipoTarjeta->getCardTypes();
        return view('card-type/card-type.list', ['tipoTarjeta' => $tipoTarjeta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('card-type/card-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoTarjeta = new TipoTarjeta($request->all());
        $tipoTarjeta->save();
        return redirect()->action([TipoTarjetaController::class, 'index']);
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
        $tipoTarjeta = $this->tipoTarjeta->getCardTypeById($id);
        return view('card-type/card-type.edit', ['tipoTarjeta' => $tipoTarjeta]);
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
        $tipoTarjeta = TipoTarjeta::find($id);
        $tipoTarjeta->fill($request->all());
        $tipoTarjeta->save();
        return redirect()->action([TipoTarjetaController::class, 'index']);
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
