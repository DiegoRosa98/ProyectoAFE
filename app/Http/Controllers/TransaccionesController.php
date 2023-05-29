<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaccionesController extends Controller
{
    protected $transacciones;

    public function __construct(Transacciones $transacciones){
        $this->transacciones = $transacciones;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transacciones = $this->transacciones->getTransactions();
        return view('transactions/transactions.list', ['transacciones' => $transacciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions/transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transacciones = new Transacciones($request->all());
        $transacciones->save();
        return redirect()->actTransaccionesion([TransaccionesController::class, 'index']);
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
