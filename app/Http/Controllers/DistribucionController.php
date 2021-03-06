<?php

namespace App\Http\Controllers;
use Session;
use App\Administrativa;
use App\Distribucion;
use App\Cotizacion;
use App\Valorcot;
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
        $cotizaciones = Cotizacion::all();

        return view('distribuciones.create',compact('codigos','cotizaciones'));
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
      if (empty($request->codigo_proyecto) && empty($request->codigo_cotizacion)) {
        Session::flash('message', 'Seleccione al menos un codigo!');
        Session::flash('class', 'danger');
        return redirect()->route('distribuciones.create');
      }else {
        for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {

            if (!is_null($input['distribucion']['descripcion_dis'][$x]) &&
                !is_null($input['distribucion']['tipo_dis'][$x]) &&
                !is_null($input['distribucion']['nivel_tension_dis'][$x]) &&
                !is_null($input['distribucion']['cantidad_dis'][$x]) &&
                !is_null($input['distribucion']['apoyos_dis'][$x])  &&
                !is_null($input['distribucion']['cajas_dis'][$x])){

                  $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                  $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                  $datos2['nivel_tension'] = $input['distribucion']['nivel_tension_dis'][$x];
                  $datos2['unidad'] = 'mts.';
                  $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);

                  if ($datos2['tipo'] == 'Aérea' && $input['distribucion']['apoyos_dis'][$x] == 0) {

                    $datos2['apoyos'] = 'Según Plano';

                  }else {
                    $datos2['apoyos'] = $input['distribucion']['apoyos_dis'][$x];
                  }


                  if ($datos2['tipo'] == 'Subterránea' && $input['distribucion']['cajas_dis'][$x] == 0) {

                    $datos2['cajas'] = 'Según Plano';

                  }else {
                    $datos2['cajas'] = $input['distribucion']['cajas_dis'][$x];
                  }

                  // $datos2['notas'] = $input['distribucion']['notas_dis'][$x];
                  $datos2['administrativa_id'] = $request->codigo_proyecto;
                  $datos2['cotizacion_id'] = $request->codigo_cotizacion;

                  $texto['detalles'] = $datos2['descripcion'].' '.$datos2['tipo'].' '. $datos2['cantidad'];
                  $texto['cantidad'] = $datos2['cantidad'];
                  $texto['valor_uni'] = 0;
                  $texto['valor_total'] = 0;
                  $texto['cotizacion_id'] = $request->codigo_cotizacion;

                  Valorcot::create($texto);
                  Distribucion::create($datos2);
            }
        }
        Session::flash('message', 'Alcance proceso de distribución creado!');
        Session::flash('class', 'success');
        return redirect()->route('distribuciones.create');

      }



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
         $datos['tipo'] = $input['distribucion']['tipo_dis'][$x];
         $datos['nivel_tension'] = $input['distribucion']['nivel_tension_dis'][$x];
         $datos['unidad'] = 'mts.';
         $datos['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);

         if ($datos['tipo'] == 'Aérea' && $input['distribucion']['apoyos_dis'][$x] == 0) {

           $datos['apoyos'] = 'Según Plano';

         }else {
           $datos['apoyos'] = $input['distribucion']['apoyos_dis'][$x];
         }


         if ($datos['tipo'] == 'Subterránea' && $input['distribucion']['cajas_dis'][$x] == 0) {

           $datos['cajas'] = 'Según Plano';

         }else {
           $datos['cajas'] = $input['distribucion']['cajas_dis'][$x];
         }

        //  $datos['notas'] = $input['distribucion']['notas_dis'][$x];

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
      // dd($id);
      // die();
      $distri = Distribucion::findOrFail($id);
      // dd($distri);
      // die();
      $distri->delete();
      Session::flash('message', 'Alcance distribución eliminado');
      Session::flash('class', 'danger');
       return redirect()->route('administrativas.index');

    }
}
