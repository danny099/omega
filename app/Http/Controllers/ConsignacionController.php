<?php

namespace App\Http\Controllers;
use App\Consignacion;
use App\Administrativa;
use Illuminate\Http\Request;

class ConsignacionController extends Controller
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

        Consignacion::create($input); //funcion para crear el registro

        $consignaciones = Consignacion::all();//funcion para recuperar todos los registros en la base de datos

        $lastId_consig = $consignaciones->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

        $consignacion = Consignacion::find($lastId_consig);//funcion que permite encontrar un registro mediante un id

        $administrativa = Administrativa::find($consignacion->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id

        $nuevo_saldo = $administrativa->saldo - $consignacion->valor;

        $administrativa->saldo = $nuevo_saldo;
        $administrativa->save();

        return redirect()->route('administrativas.index');

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
        //
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
        //
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
