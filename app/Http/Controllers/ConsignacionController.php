<?php

namespace App\Http\Controllers;
use App\Consignacion;
use App\Administrativa;
use Session;
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
    // funcion que me permite guardar los datos optenidos de un formulario
    public function store(Request $request)
    {

        $input = $request->all();
        $administrativa = Administrativa::find($request->administrativa_id);

        if ($administrativa->saldo > str_replace(',','',$request->valor)) {
          $datos['fecha_pago'] = $request->fecha_pago;
          $datos['valor'] = str_replace(',','',$request->valor);
          $datos['valor_iva'] = str_replace(',','',$request->valor_iva);
          $datos['valor_total'] = str_replace(',','',$request->valor_total);
          $datos['observaciones'] = ucfirst(mb_strtolower($request->observaciones));
          // ucwords(strtolower());
          $datos['administrativa_id'] = $request->administrativa_id ;


          $administrativa = Administrativa::find($request->administrativa_id);
          Consignacion::create($datos);
          Session::flash('message', 'El valor de la consignación creado!');
          Session::flash('class', 'success');
          return redirect()->route('administrativas.index');
        }else {
          Session::flash('message', 'El valor de la consignación no puede ser mayor al saldo!');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');
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
     // funcion que permite buscar un registro mediante el id y asi mostrar todos sus datos en una vista para poderlos editar
     public function edit($id)
     {
       $ide = Administrativa::find($id);
       $consignaciones = Consignacion::where('Consignacion.administrativa_id', '=', $id)->get();
       return view('consignaciones.edit',compact('consignaciones','id','ide'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      // funcion que permite editar los valores ingresados por el usuario guardandolos en la base de datos
      public function editar(Request $request)
      {
        $input = $request->all();

        // $ide = Consignacion::findOrFail($input['consignacion']['id']);

        $ide = Administrativa::select('id')->where('id',$input['consignacion']['administrativa_id'])->get();

        $administrativa = Administrativa::findOrFail($ide);

        for ($a=0; $a<count($input['consignacion']['fecha_pago']); $a++){

          if ($administrativa->saldo > str_replace(',','',$input['consignacion']['valor'][$a])) {
            $consignacion = Consignacion::findOrFail($input['consignacion']['id'][$a]);
            $administrativa = Administrativa::findOrFail($consignacion->administrativa_id);

            // if ($administrativa->saldo > 0) {
            //
            //   $resta = $administrativa->saldo - $consignacion->valor;
            //   $nuevo_saldo = $resta + $request->consignacion['valor'][$a];
            //   $administrativa->saldo = $nuevo_saldo;
            //   $administrativa->save();
            //
            // }
            $datos['fecha_pago'] = $input['consignacion']['fecha_pago'][$a];
            $datos['valor'] = str_replace(',','',$input['consignacion']['valor'][$a]);
            $datos['valor_iva'] = str_replace(',','',$input['consignacion']['valor_iva'][$a]);
            $datos['valor_total'] = str_replace(',','',$input['consignacion']['valor_total'][$a]);
            $datos['observaciones'] = ucfirst(mb_strtolower($input['consignacion']['observaciones'][$a]));

            $consignacion->update($datos);

          }else {
            Session::flash('message', 'Valor de la consignación no puede ser mayor al saldo');
            Session::flash('class', 'success');
            return redirect()->route('administrativas.index');
          }

        }

        Session::flash('message', 'registro editado!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');
      }

     public function update(Request $request, $id)
     {
       $input = $request->all();

       $consignaciones = Consignacion::findOrFail($id);
       $administrativa = Administrativa::findOrFail($consignaciones->administrativa_id);
       $consignaciones->update($input);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // funcion que permite eliminar los registro de acuerdo al que sea seleccionado
     public function destroy($id)
     {
       $consignaciones = Consignacion::findOrFail($id);
       $administrativas = Administrativa::findOrFail($consignaciones->administrativa_id);

       $consignaciones->delete();
       Session::flash('message', 'Consignación eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');

     }
}
