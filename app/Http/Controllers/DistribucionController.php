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
              !empty($input['distribucion']['cantidad_dis'][$x] &&
              !empty($input['distribucion']['apoyos_dis'][$x] &&
              !empty($input['distribucion']['cajas_dis'][$x] &&
              !empty($input['distribucion']['notas_dis'][$x])){

                $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                $datos2['unidad'] = $input['distribucion']['unidad_distribucion'][$x];
                $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);
                $datos2['apoyos'] = $input['distribucion']['apoyos_dis'][$x]
                $datos2['cajas'] = $input['distribucion']['cajas_dis'][$x]
                $datos2['notas'] = $input['distribucion']['notas_dis'][$x]
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
     public function editar(Request $request)
     {

       $input = $request->all();

       for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {

         $distri = Distribucion::findOrFail($request->distribucion['id'][$x]);

         $datos['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
         $datos['tipo'] = $input['distribucion']['tipo_dis'][$x];
         $datos['unidad'] = $input['distribucion']['unidad_distribucion'][$x];
         $datos['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);
         $datos['apoyos'] = $input['distribucion']['apoyos_dis'][$x]
         $datos['cajas'] = $input['distribucion']['cajas_dis'][$x]
         $datos['notas'] = $input['distribucion']['notas_dis'][$x]

         $distri->update($datos);

       }


       Session::flash('message', 'Alcance de distribución editado!');
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
      Session::flash('message', 'Alcance distribución eliminado');
      Session::flash('class', 'danger');
       return redirect()->route('administrativas.index');

    }
}
