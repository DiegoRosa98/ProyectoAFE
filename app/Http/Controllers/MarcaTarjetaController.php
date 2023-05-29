<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaTarjeta;

class MarcaTarjetaController extends Controller
{
    protected $marcas;

    public function __construct(MarcaTarjeta $marcas){
        $this->marcas = $marcas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = $this->marcas->getCardBrands();
        return view('card-brands/card-brands.list', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('card-brands/card-brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marcas = new MarcaTarjeta($request->all());
        $marcas->save();
        return redirect()->action([MarcaTarjetaController::class, 'index']);
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
        $marcas = $this->marcas->getCardBrandById($id);
        return view('card-brands/card-brands.edit', ['marcas' => $marcas]);
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
        $marcas = MarcaTarjeta::find($id);
        $marcas->fill($request->all());
        $marcas->save();
        return redirect()->action([MarcaTarjetaController::class, 'index']);
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
