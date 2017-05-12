<?php

namespace App\Http\Controllers;
use Session;
use App\Administrativa;
use App\Distribucion;
use Illuminate\Http\Request;

class DistribucionController extends Controller
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
        $codigos = Administrativa::all();
        return view('distribuciones.create',compact('codigos'));
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

      for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {

          if (!empty($input['distribucion']['descripcion_dis'][$x]) &&
              !empty($input['distribucion']['tipo_dis'][$x]) &&
              !empty($input['distribucion']['unidad_distribucion'][$x]) &&
              !empty($input['distribucion']['cantidad_dis'][$x])){

                $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                $datos2['unidad'] = $input['distribucion']['unidad_distribucion'][$x];
                $datos2['cantidad'] = $input['distribucion']['cantidad_dis'][$x];
                $datos2['administrativa_id'] =$input['codigo_proyecto'];

                Distribucion::create($datos2);
          }
      }

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
      $ide = Administrativa::findOrFail($id);
      $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
      return view('distribuciones.edit',compact('distribuciones','id','ide'));


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
      $input = $request->all();

      $distri = Distribucion::findOrFail($id);
      $distri->update($input);

      Session::flash('message', 'registro editado editado!');
      Session::flash('class', 'success');
      return redirect()->route('administrativas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $distri = Distribucion::findOrFail($id);
      $distri->delete();
      Session::flash('message', 'Alcance Transformacion eliminado');
      Session::flash('class', 'danger');
      return redirect();
    }
}
