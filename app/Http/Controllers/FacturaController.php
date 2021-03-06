<?php

namespace App\Http\Controllers;
use Session;
use App\Factura;
use App\Administrativa;
use Illuminate\Http\Request;

class FacturaController extends Controller
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

      // $Administrativa = Administrativa::findOrFail();
      // return view('facturas.create');

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


       //funcion para sacar todos los valores almacenados en los input
      $administrativa = Administrativa::find($request->administrativa_id);


      $administrativa->save();

      $datos['num_factura'] = $request->num_factura;
      $datos['fecha_factura'] = $request->fecha_factura;
      $datos['valor_factura'] = str_replace(',','',$request->valor_factura);
      $datos['iva'] =  str_replace(',','',$request->iva);
      $datos['valor_total'] = str_replace(',','',$request->valor_total);
      $datos['rete_porcen'] = str_replace(',','.',$request->rete_porcen);
      $datos['retenciones'] = str_replace(',','',$request->retenciones);
      $datos['amortizacion'] = str_replace(',','',$request->amortizacion);
      $datos['polizas'] = str_replace(',','',$request->polizas);
      $datos['retegaran_porcen'] =str_replace(',','.',$request->retegaran_porcen);
      $datos['retegarantia'] = str_replace(',','',$request->retegarantia);
      $datos['valor_pagado'] = str_replace(',','',$request->valor_pagado);
      $datos['fecha_pago'] = $request->fecha_pago;
      $datos['observaciones'] = ucfirst(mb_strtolower($request->observaciones));
      $datos['administrativa_id'] = $request->administrativa_id;

      $numrepe = Factura::where('num_factura',$request->num_factura)->get();


      if ($request->recuerdame == 1) {
        $datos['recuerdame'] = 1;
      }else {
        $datos['recuerdame'] = 0;

      }
      if ($datos['valor_total'] <= $administrativa->saldo) {

        if ($numrepe->count() == 1) {
          Session::flash('message', 'El numero de la factura ya está registrado!');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');
        }
        else {
          Factura::create($datos);
          $facturas = Factura::all();//funcion para recuperar todos los registros en la base de datos

          $lastId_factura = $facturas->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

          $factura = Factura::find($lastId_factura);//funcion que permite encontrar un registro mediante un id

          $administrativa = Administrativa::find($factura->administrativa_id);//funcion que hace una consulta a una tabla relacionada en la base de datos y saca un registro mediante un id
          $administrativa->contador_fac = $administrativa->contador_fac + $request->recuerdame;
          // dd($administrativa->contador_fac);
          // die();
          $administrativa->save();

          $saldo = $administrativa->saldo - $factura->valor_total;
          $administrativa->saldo =$saldo;
          $administrativa->save();

          // $nuevo = $administrativa->pagado + $factura->valor_total;  //
          //
          // $administrativa->pagado = $nuevo;//asignacion de una variable a actualizar
          // $administrativa->save();

          Session::flash('message', 'Factura creada');
          Session::flash('class', 'success');

          return redirect()->route('administrativas.index');
        }





      }else {
        Session::flash('message', 'El valor de la Factura es mayor al saldo!');
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
    public function edit($id)
    {
      $ide = Administrativa::find($id);
      $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();

      // dd($transformaciones);
      // die();
      return view('facturas.index',compact('facturas','id','ide'));
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

        $datos['num_factura'] = $request->num_factura;
        $datos['fecha_factura'] = $request->fecha_factura;
        $datos['valor_factura'] = str_replace(',','',$request->valor_factura);
        $datos['iva'] =  str_replace(',','',$request->iva);
        $datos['valor_total'] = str_replace(',','',$request->valor_total);
        $datos['rete_porcen'] = str_replace(',','.',$request->retencionesporcen);
        $datos['retenciones'] = str_replace(',','',$request->retenciones);
        $datos['amortizacion'] = str_replace(',','',$request->amortizacion);
        $datos['polizas'] = str_replace(',','',$request->polizas);
        $datos['retegaran_porcen'] =str_replace(',','.',$request->retegarantiaporcen);
        $datos['retegarantia'] = str_replace(',','',$request->retegarantia);
        $datos['valor_pagado'] = str_replace(',','',$request->valor_pagado);
        $datos['fecha_pago'] = $request->fecha_pago;
        $datos['observaciones'] = ucfirst(mb_strtolower($request->observaciones));
        $datos['recuerdame'] = $request->recuerdame;


        $factura = Factura::findOrFail($id);
        $administrativa = Administrativa::findOrFail($factura->administrativa_id);

        if ($factura->valor_total == $datos['valor_total']) {

          if ($datos['recuerdame'] == 0) {


            if ($factura->recuerdame == 1) {

              $administrativa->contador_fac = $administrativa->contador_fac - 1;
              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];

              $administrativa->save();

            }

            if ($factura->recuerdame == 0) {

              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

            }
          }else {
            if ($factura->recuerdame == 1) {

              $administrativa->contador_fac = $administrativa->contador_fac - $datos['recuerdame'];
              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

              // $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              // $administrativa->save();
            }
            if ($factura->recuerdame == 0) {

              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

            }

          }

          $factura->update($datos);

          Session::flash('message', 'Factura editada!');
          Session::flash('class', 'success');
          return redirect()->route('administrativas.index');
        }


        if($administrativa->saldo >= $datos['valor_total']){

          $suma = $administrativa->saldo + $factura->valor_total;
          $resta = $suma - $datos['valor_total'];
          $administrativa->saldo = $resta;
          $administrativa->save();

          if ($datos['recuerdame'] == 0) {



            if ($factura->recuerdame == 1) {

              $administrativa->contador_fac = $administrativa->contador_fac - 1;
              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];

              $administrativa->save();

            }

            if ($factura->recuerdame == 0) {

              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

            }
          }else {
            if ($factura->recuerdame == 1) {

              $administrativa->contador_fac = $administrativa->contador_fac - $datos['recuerdame'];
              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

              // $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              // $administrativa->save();
            }
            if ($factura->recuerdame == 0) {
              dd('hola');
              die();
              $administrativa->contador_fac = $administrativa->contador_fac + $datos['recuerdame'];
              $administrativa->save();

            }

          }

          $factura->update($datos);

          Session::flash('message', 'Factura editada!');
          Session::flash('class', 'success');
          return redirect()->route('administrativas.index');


        }

        if($administrativa->saldo < $datos['valor_total']){
          // $suma = $factura->valor_total + $administrativa->saldo;
          // $resta = $datos['valor_total'] - $suma;
          // $administrativa->saldo = $resta;
          // // dd('dos');
          // // die();
          // $administrativa->save();
          Session::flash('message', 'El valor de la factura es mayor al saldo!');
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
      $factu = Factura::findOrFail($id);
      $administrativas = Administrativa::findOrFail($factu->administrativa_id);

      if ($factu->recuerdame == 1) {
        $administrativas->contador_fac = $administrativas->contador_fac - 1;
        $administrativas->save();
      }

      $nuevo_saldo = $administrativas->saldo + $factu->valor_total;
      $administrativas->saldo = $nuevo_saldo;
      $administrativas->save();

      // $pagado = $administrativas->pagado - $factu->valor_total;
      // $administrativas->pagado = $pagado;
      // $administrativas->save();

      $factu->delete();

      Session::flash('message', 'Factura eliminada');
      Session::flash('class', 'danger');
      return redirect('administrativas');

    }
}
