<?php

namespace App\Http\Controllers;
use App\Transformacion;
use Illuminate\Http\Request;

class TransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $descripcion;
    var $tipo;
    var $capacidad;
    var $cantidad;

    public function __contruct($descripcion,$tipo,$capacidad,$cantidad){

      $this->descripcion = $descripcion;
      $this->tipo = $tipo;
      $this->capacidad = $capacidad;
      $this->cantidad = $cantidad;

    }
    public function index()
    {
      $transformaciones=Transformacion::all();

      return view('transformacion.index',compact('transformaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($descripcion,$tipo,$capacidad,$cantidad)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $datos['descripcion'] = $this->descripcion;
      $datos['tipo'] = $this->cantidad;
      $datos['capacidad'] = $this->capacidad;
      $datos['cantidad'] = $this->descripcion;

      Transformacion::create($datos);
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
