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
    public function store(Request $request)
    {

        $input = $request->all();
        $administrativa = Administrativa::find($request->administrativa_id);

        if ($administrativa->saldo > str_replace(',','',$request->valor)) {
          $datos['fecha_pago'] = $request->fecha_pago;
          $datos['valor'] = str_replace(',','',$request->valor);
          $datos['observaciones'] = ucfirst(strtolower($request->observaciones));
          // ucwords(strtolower());
          $datos['administrativa_id'] = $request->administrativa_id ;


          $administrativa = Administrativa::find($request->administrativa_id);
          Consignacion::create($datos);
          Session::flash('message', 'El valor de la consignacion creada!');
          Session::flash('class', 'success');
          return redirect()->route('administrativas.index');
        }else {
          Session::flash('message', 'El valor de la consignacion no puede ser mayor al saldo!');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');
        }


        // if ($request->valor <= $administrativa->saldo ) {
        //
        //    //funcion para crear el registro
        //
        //   $consignaciones = Consignacion::all();//funcion para recuperar todos los registros en la base de datos
        //
        //   $lastId_consig = $consignaciones->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo
        //
        //   $consignacion = Consignacion::find($lastId_consig);//funcion que permite encontrar un registro mediante un id
        //
        //   $administrativa = Administrativa::find($consignacion->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id
        //
        //   $nuevo = $administrativa->pagado + $consignacion->valor;//operacion para almacenar un valor en una varible.
        //
        //   $administrativa->pagado = $nuevo;//asigancion del nuevo valor para actualizar en la base de datos relacionada.
        //   $administrativa->save();
        //
        //   $saldo = $administrativa->saldo - $consignacion->valor;
        //
        //   $administrativa->saldo = $saldo;
        //   $administrativa->save();
        //
        //   return redirect()->route('administrativas.index');
        //
        // }else {
        //
        //   Session::flash('message', 'El valor de la consignacion es mayor al saldo!');
        //   Session::flash('class', 'danger');
        //   return redirect()->route('administrativas.index');
        //
        //
        // }



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
      public function editar(Request $request)
      {
        $input = $request->all();

        // $adicional = Valor_adicional::findOrFail($id);
        $administrativa = Administrativa::findOrFail($adicional->administrativa_id);

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
            $datos['observaciones'] = ucfirst(strtolower($input['consignacion']['observaciones'][$a]));

            $consignacion->update($datos);

          }else {
            Session::flash('message', 'Valor de la consignacion no puede ser mayor al saldo');
            Session::flash('class', 'success');
            return redirect()->route('administrativas.index');
          }

        }

        Session::flash('message', 'registro editado editado!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');
      }

     public function update(Request $request, $id)
     {
       $input = $request->all();

       $consignaciones = Consignacion::findOrFail($id);
       $administrativa = Administrativa::findOrFail($consignaciones->administrativa_id);
       $consignaciones->update($input);

      //  if ($request->valor <= $administrativa->saldo) {
      //    $resta = $administrativa->saldo - $consignaciones->valor;
      //    $administrativa->saldo = $resta;
      //    $administrativa->save();
       //
      //    $suma = $administrativa->saldo + $request->valor_total;
      //    $administrativa->saldo = $suma;
      //    $administrativa->save();
       //
      //    $consignaciones->update($input);
       //
      //    Session::flash('message', 'registro editado!');
      //    Session::flash('class', 'success');
      //    return redirect()->route('administrativas.index');
       //
      //  }else {
       //
      //    Session::flash('message', 'El valor de la consignacion es mayor al saldo!');
      //    Session::flash('class', 'danger');
      //  }


     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
       $consignaciones = Consignacion::findOrFail($id);
       $administrativas = Administrativa::findOrFail($consignaciones->administrativa_id);

      //  $nuevo_saldo = $administrativas->saldo + $consignaciones->valor;
      //  $administrativas->saldo = $nuevo_saldo;
      //  $administrativas->save();

      //  $pagado = $administrativas->pagado - $consignaciones->valor;
      //  $administrativas->pagado = $pagado;
      //  $administrativas->save();

       $consignaciones->delete();

       Session::flash('message', 'Consignacion  eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');

     }
}
