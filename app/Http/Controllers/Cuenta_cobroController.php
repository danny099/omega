<?php

namespace App\Http\Controllers;

use App\Cuenta_cobro;
use Session;
use App\Administrativa;
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
    // funcion que nos permite guardar los datos de la cuenta de cobro
    public function store(Request $request)
    {
      $input = $request->all();
      $administrativa = Administrativa::find($request->administrativa_id);

      if ($administrativa->saldo > str_replace(',','',$request->valor)) {
        $datos['porcentaje'] = $request->porcentaje;
        $datos['valor'] = str_replace(',','',$request->valor);
        $datos['fecha_cuenta_cobro'] = $request->fecha_cuenta_cobro;
        $datos['fecha_pago'] = $request->fecha_pago;
        $datos['numero_cuenta_cobro'] = $request->numero_cuenta_cobro;
        $datos['observaciones'] = ucfirst(mb_strtolower($request->observaciones));
        $datos['administrativa_id'] = $request->administrativa_id;

        $administrativa = Administrativa::find($request->administrativa_id);

        // if ($request->valor <= $administrativa->saldo){

        Cuenta_cobro::create($datos); //funcion para crear el registro
        Session::flash('message', 'Cuenta de cobro creada!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');
      }else {

        Session::flash('message', 'El valor de la cuenta de cobro no puede ser mayor al saldo!');
        Session::flash('class', 'danger');
        return redirect()->route('administrativas.index');
      }

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
     // funcion que permite buscar un registro para ser editado
     public function edit($id)
     {
       $ide = Administrativa::find($id);
       $cuentas = Cuenta_cobro::where('Cuenta_cobro.administrativa_id', '=', $id)->get();
       return view('cuenta_cobros.edit',compact('cuentas','id','ide'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      // funcion que nos permite editar un registro seleccionado
      public function editar(Request $request)
      {
        $input = $request->all();
        $ide = Administrativa::select('id')->where('id',$input['cuenta']['administrativa_id'])->get();

        $administrativa = Administrativa::findOrFail($ide);

        for ($a=0; $a<count($input['cuenta']['porcentaje']); $a++){

          if ($administrativa->saldo > str_replace(',','',$input['cuenta']['valor'][$a])) {
            $cuenta = Cuenta_cobro::findOrFail($request->cuenta['id'][$a]);
            $administrativa = Administrativa::findOrFail($cuenta->administrativa_id);
            $datos['porcentaje'] = $input['cuenta']['porcentaje'][$a];
            $datos['valor'] =  str_replace(',','',$input['cuenta']['valor'][$a]);
            $datos['fecha_cuenta_cobro'] = $input['cuenta']['fecha_cuenta_cobro'][$a];
            $datos['fecha_pago'] = $input['cuenta']['fecha_pago'][$a];
            $datos['numero_cuenta_cobro'] = $input['cuenta']['numero_cuenta_cobro'][$a];
            $datos['observaciones'] = ucfirst(mb_strtolower($input['cuenta']['observaciones'][$a]));

            $cuenta->update($datos);

          }else {
            Session::flash('message', 'Valor de la cuenta de cobro es mayor al saldo');
            Session::flash('class', 'danger');
            return redirect()->route('administrativas.index');
          }

        }
        Session::flash('message', 'Cuenta de cobro editada!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');
     }
     public function update(Request $request, $id)
     {
       $input = $request->all();

       $cuentas = Cuenta_cobro::findOrFail($id);
       $administrativa = Administrativa::findOrFail($cuentas->administrativa_id);

       if ($request->valor <= $administrativa->saldo) {
         $resta = $administrativa->saldo - $cuentas->valor;
         $administrativa->saldo = $resta;
         $administrativa->save();

         $suma = $administrativa->saldo + $request->valor_total;
         $administrativa->saldo = $suma;
         $administrativa->save();

         $consignaciones->update($input);

         Session::flash('message', 'Cuenta de cobro editada!');
         Session::flash('class', 'success');
         return redirect()->route('administrativas.index');

       }else {

         Session::flash('message', 'El valor de la Cuenta de cobro es mayor al saldo!');
         Session::flash('class', 'danger');
         return redirect()->route('administrativas.index');


       }
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      // funcion que nos permite eliminar un registro seleccionado por el usuario
     public function destroy($id)
     {
       $cuentas = Cuenta_cobro::findOrFail($id);
       $administrativas = Administrativa::findOrFail($cuentas->administrativa_id);

       $nuevo_saldo = $administrativas->saldo + $cuentas->valor;
       $administrativas->saldo = $nuevo_saldo;
       $administrativas->save();

       $cuentas->delete();

       Session::flash('message', 'Cuenta cobro eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');

     }
 }
