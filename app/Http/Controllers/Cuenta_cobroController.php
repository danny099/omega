<?php

namespace App\Http\Controllers;

use App\Cuenta_cobro;
use Illuminate\Http\Request;

class Cuenta_cobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        // die();
        Cuenta_cobro::create($input);
        return redirect()->route('administrativas.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cuentacobroco  $cuentacobroco
     * @return \Illuminate\Http\Response
     */
    public function show(Cuentacobroco $cuentacobroco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cuentacobroco  $cuentacobroco
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuentacobroco $cuentacobroco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cuentacobroco  $cuentacobroco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuentacobroco $cuentacobroco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cuentacobroco  $cuentacobroco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuentacobroco $cuentacobroco)
    {
        //
    }
}
