<?php

namespace App\Http\Controllers;
use Session;
use App\Transformacion;
use App\Administrativa;
use App\Cotizacion;
use App\Valorcot;
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
      $cotizaciones = Cotizacion::all();
      // dd($cotizaciones);
      // die();
      $codigos = Administrativa::all();

      // dd($codigos);
      // die();
      return view('transformaciones.create',compact('codigos','cotizaciones'));
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

            if (!is_null($input['transformacion']['descripcion'][$a]) &&
                !is_null($input['transformacion']['tipo'][$a]) &&
                !is_null($input['transformacion']['nivel_tension'][$a]) &&
                !is_null($input['transformacion']['capacidad'][$a]) &&
                !is_null($input['transformacion']['cantidad'][$a]) &&
                !is_null($input['transformacion']['tipo_refrigeracion'][$a])) {

                  $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
                  $datos1['tipo'] = $input['transformacion']['tipo'][$a];
                  $datos1['nivel_tension'] = $input['transformacion']['nivel_tension'][$a];
                  $datos1['unidad'] = 'Und';
                  $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
                  $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
                  $datos1['tipo_refrigeracion'] = $input['transformacion']['tipo_refrigeracion'][$a];
                  $datos1['administrativa_id'] = $request->codigo_proyecto;
                  $datos1['cotizacion_id'] = $request->codigo_cotizacion;

                  $texto['detalles'] = $datos1['descripcion'].' '.$datos1['tipo'].' '. $datos1['cantidad'].' '.$datos1['capacidad'];
                  $texto['cantidad'] = $datos1['cantidad'];
                  $texto['valor_uni'] = 0;
                  $texto['valor_total'] = 0;
                  $texto['cotizacion_id'] = $request->codigo_cotizacion;

                  Valorcot::create($texto);
                  Transformacion::create($datos1);

            }
          }
      Session::flash('message', 'Alcance de transformación creado!');
      Session::flash('class', 'success');
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
      $ide = Administrativa::find($id);
      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();

      // dd($transformaciones);
      // die();
      return view('transformaciones.edit',compact('transformaciones','id','ide'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
      $input = $request->all();

      for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

        $transfor = Transformacion::findOrFail($request->transformacion['id'][$a]);

        $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
        $datos1['tipo'] = $input['transformacion']['tipo'][$a];
        $datos1['nivel_tension'] = $input['transformacion']['nivel_tension'][$a];
        $datos1['unidad'] = 'Und';
        $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
        $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
        $datos1['tipo_refrigeracion'] = $input['transformacion']['tipo_refrigeracion'][$a];


        $transfor->update($datos1);

      }

      Session::flash('message', 'Alcance de transformación editado!');
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

       Session::flash('message', 'Alcance Transformación eliminado');
       Session::flash('class', 'danger');
       return redirect()->route('administrativas.index');

    }
}
