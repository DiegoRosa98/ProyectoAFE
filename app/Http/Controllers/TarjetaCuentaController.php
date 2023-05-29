<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarjetaCuentaController extends Controller
{
    protected $tarjetas;

    public function __construct(TarjetaCuenta $tarjetas){
        $this->tarjetas = $tarjetas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarjetas = $this->tarjetas->getCards();
        return view('cards/cards.list', ['tarjetas' => $tarjetas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cards/cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarjetas = new TarjetaCuenta($request->all());
        $tarjetas->save();
        return redirect()->action([TarjetaCuentaController::class, 'index']);
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
        $tarjetas = $this->tarjetas->getCardById($id);
        return view('cards/cards.edit', ['tarjetas' => $tarjetas]);
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
        $tarjetas = TarjetaCuenta::find($id);
        $tarjetas->fill($request->all());
        $tarjetas->save();
        return redirect()->action([TarjetaCuentaController::class, 'index']);
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
