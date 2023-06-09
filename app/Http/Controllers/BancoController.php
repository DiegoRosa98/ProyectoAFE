<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banco;

class BancoController extends Controller
{
    protected $bancos;

    public function __construct(Banco $bancos){
        $this->bancos = $bancos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = $this->bancos->getBanks();
        return view('banks.list', ['bancos' => $bancos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bancos = new Banco($request->all());
        $bancos->save();
        return redirect()->action([BancoController::class, 'index'])->with('message', 'Created successfully.');
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
        $bancos = $this->bancos->getBankById($id);
        return view('banks.edit', ['bancos' => $bancos]);
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
        $bancos = Banco::find($id);
        $bancos->fill($request->all());
        $bancos->save();
        return redirect()->action([BancoController::class, 'index'])->with('message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Banco::find($id);
        if($usuarios->count() > 0){
            Banco::where('id', $id)->update(array('estado' => 0));
        }
        return redirect()->action([BancoController::class, 'index'])->with('message', 'Deleted successfully.');
    }
}
