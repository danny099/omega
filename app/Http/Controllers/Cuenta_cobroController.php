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
    public function store(Request $request)
    {
      $input = $request->all();

      $datos['porcentaje'] = $request->porcentaje;
      $datos['valor'] = str_replace(',','',$request->valor);
      $datos['fecha_cuenta_cobro'] = $request->fecha_cuenta_cobro;
      $datos['fecha_pago'] = $request->fecha_pago;
      $datos['numero_cuenta_cobro'] = $request->numero_cuenta_cobro;
      $datos['observaciones'] = $request->observaciones;
      $datos['administrativa_id'] = $request->administrativa_id;

      $administrativa = Administrativa::find($request->administrativa_id);

      // if ($request->valor <= $administrativa->saldo){

        Cuenta_cobro::create($datos); //funcion para crear el registro

        // $cobros = Cuenta_cobro::all();//funcion para recuperar todos los registros en la base de datos
        //
        // $lastId_cobro = $cobros->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo
        //
        // $cobro = Cuenta_cobro::find($lastId_cobro);//funcion que permite encontrar un registro mediante un id
        //
        // $administra = Administrativa::find($cobro->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id
        //
        // $nuevo = $administra->pagado + $cobro->valor;//linea donde se restan los valores almacenados en variables
        //
        // $administra->pagado = $nuevo;//asignacion de una variable a actualizar
        // $administra->save();
        //
        // $saldo = $administra->saldo - $cobro->valor;
        // $administra->saldo = $saldo;
        // $administra->save();

        // return redirect()->route('administrativas.index');

      // }else {

        Session::flash('message', 'Cuenta de cobro creada!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');


      // }

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
      public function editar(Request $request)
      {
        $input = $request->all();


        // $adicional = Valor_adicional::findOrFail($id);
        // $administrativa = Administrativa::findOrFail($adicional->administrativa_id);

        for ($a=0; $a<count($input['cuenta']['porcentaje']); $a++){


          $cuenta = Cuenta_cobro::findOrFail($request->cuenta['id'][$a]);
          $administrativa = Administrativa::findOrFail($cuenta->administrativa_id);

          // if ($administrativa->saldo > 0) {
          //
          //   $resta = $administrativa->saldo - $cuenta->valor;
          //   $nuevo_saldo = $resta + $request->cuenta['valor'][$a];
          //   $administrativa->saldo = $nuevo_saldo;
          //   $administrativa->save();
          //
          // }
          $datos['porcentaje'] = $input['cuenta']['porcentaje'][$a];
          $datos['valor'] =  str_replace(',','',$input['cuenta']['valor'][$a]);
          $datos['fecha_cuenta_cobro'] = $input['cuenta']['fecha_cuenta_cobro'][$a];
          $datos['fecha_pago'] = $input['cuenta']['fecha_pago'][$a];
          $datos['numero_cuenta_cobro'] = $input['cuenta']['numero_cuenta_cobro'][$a];
          $datos['observaciones'] = $input['cuenta']['observaciones'][$a];


          $cuenta->update($datos);



        }
        Session::flash('message', 'registro editado!');
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

         Session::flash('message', 'registro editado!');
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
     public function destroy($id)
     {
       $cuentas = Cuenta_cobro::findOrFail($id);
       $administrativas = Administrativa::findOrFail($cuentas->administrativa_id);

       $nuevo_saldo = $administrativas->saldo + $cuentas->valor;
       $administrativas->saldo = $nuevo_saldo;
       $administrativas->save();

      //  $pagado = $administrativas->pagado - $cuentas->valor;
      //  $administrativas->pagado = $pagado;
      //  $administrativas->save();

       $cuentas->delete();

       Session::flash('message', 'Cuenta cobro  eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');

     }
 }
