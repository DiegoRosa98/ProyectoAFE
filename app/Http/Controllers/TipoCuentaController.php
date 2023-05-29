<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCuenta;

class TipoCuentaController extends Controller
{
    protected $tipoCuenta;

    public function __construct(TipoCuenta $tipoCuenta){
        $this->tipoCuenta = $tipoCuenta;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoCuenta = $this->tipoCuenta->getAccountType();
        return view('account-type/account-type.list', ['tipoCuenta' => $tipoCuenta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account-type/account-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoCuenta = new TipoCuenta($request->all());
        $tipoCuenta->save();
        return redirect()->action([TipoCuentaController::class, 'index']);
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
        $tipoCuenta = $this->tipoCuenta->getAccountTypeById($id);
        return view('account-type/account-type.edit', ['tipoCuenta' => $tipoCuenta]);
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
        $tipoCuenta = TipoCuenta::find($id);
        $tipoCuenta->fill($request->all());
        $tipoCuenta->save();
        return redirect()->action([TipoCuentaController::class, 'index']);
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
