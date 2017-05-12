<?php

namespace App\Http\Controllers;
use App\Transformacion;
use Session;
use Illuminate\Http\Request;

class TransformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function create()
    {
      $transformaciones = Transformacion::all();
      return view('transformaciones.create');
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
      for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

            if (!empty($input['transformacion']['descripcion'][$a]) &&
                !empty($input['transformacion']['tipo'][$a]) &&
                !empty($input['transformacion']['capacidad'][$a]) &&
                !empty($input['transformacion']['unidad_transformacion'][$a]) &&
                !empty($input['transformacion']['cantidad'][$a])) {

                  $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
                  $datos1['tipo'] = $input['transformacion']['tipo'][$a];
                  $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
                  $datos1['unidad'] = $input['transformacion']['unidad_transformacion'][$a];
                  $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
                  $datos1['administrativa_id'] = $input['id_admin'];

                  Transformacion::create($datos1);
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
      // $transformaciones = Transformacion::find($id);
      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
      return view('transformaciones.edit',compact('transformaciones','id'));

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

      $trans = Transformacion::findOrFail($id);

      // for ($i=0; $i<count($input['descripcion']) ; $i++) {
      //
      //   $datos['descripcion'] = $input['descripcion'][$i];
      //   $datos['tipo'] = $input['tipo'][$i];
      //   $datos['capacidad'] = $input['capacidad'][$i];
      //   $datos['unidad_transformacion'] = $input['unidad_transformacion'][$i];
      //   $datos['cantidad'] = $input['cantidada'][$i];
      //
      //
      // }
      $trans->update($input);

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
       $transfor = Transformacion::findOrFail($id);


       $transfor->delete();

       Session::flash('message', 'Alcance Transformacion eliminado');
       Session::flash('class', 'danger');
       return redirect();
    }
}
