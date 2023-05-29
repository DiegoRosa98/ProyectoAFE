<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfiles;

class PerfilesController extends Controller
{
    protected $perfiles;

    public function __construct(Perfiles $perfiles){
        $this->perfiles = $perfiles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfiles = $this->perfiles->getProfiles();
        return view('profiles/profiles.list', ['perfiles' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles/profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perfiles = new Perfiles($request->all());
        $perfiles->save();
        return redirect()->action([PerfilesController::class, 'index']);
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
        $perfiles = $this->perfiles->getProfileById($id);
        return view('profiles/profiles.edit', ['perfiles' => $perfiles]);
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
        $perfiles = Perfiles::find($id);
        $perfiles->fill($request->all());
        $perfiles->save();
        return redirect()->action([PerfilesController::class, 'index']);
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
