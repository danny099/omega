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
      $input = $request->all(); //funcion para sacar todos los valores almacenados en los input
      $administrativa = Administrativa::find($request->administrativa_id);

      // if ($request->valor <= $administrativa->saldo){

        Cuenta_cobro::create($input); //funcion para crear el registro

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

        return redirect()->route('administrativas.index');

      // }else {

        Session::flash('message', 'El valor de la cuenta de cobro es mayor al saldo!');
        Session::flash('class', 'danger');
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

         Session::flash('message', 'El valor de la consignacion es mayor al saldo!');
         Session::flash('class', 'danger');
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

       $pagado = $administrativas->pagado - $cuentas->valor;
       $administrativas->pagado = $pagado;
       $administrativas->save();

       $cuentas->delete();

       Session::flash('message', 'Cuenta cobro  eliminada');
       Session::flash('class', 'danger');
       return redirect('administrativas');

     }
 }
