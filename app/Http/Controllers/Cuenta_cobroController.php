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
      $input = $request->all(); //funcion para sacar todos los valores almacenados en los input

      Cuenta_cobro::create($input); //funcion para crear el registro

      $cobros = Cuenta_cobro::all();//funcion para recuperar todos los registros en la base de datos

      $lastId_cobro = $cobros->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

      $cobro = Cuenta_cobro::find($lastId_cobro);//funcion que permite encontrar un registro mediante un id

      $administrativa = Administrativa::find($cobro->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id

      $nuevo_saldo = $administrativa->saldo - $cobro->valor;//linea donde se restan los valores almacenados en variables

      $administrativa->saldo = $nuevo_saldo;//asignacion de una variable a actualizar
      $administrativa->save();

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
