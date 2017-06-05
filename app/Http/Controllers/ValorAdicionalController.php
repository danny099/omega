<?php

namespace App\Http\Controllers;
use Session;
use App\Valor_adicional;
use App\Administrativa;
use Illuminate\Http\Request;

class ValorAdicionalController extends Controller
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
      $adicionales = Valor_adicional::all();
      $codigos = Administrativa::all();

      // dd($codigos);
      // die();
      Session::flash('message', 'Valor adicional creado!');
      Session::flash('class', 'success');
      return view('adicionales.create',compact('codigos'));
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
      $id = $request->codigo_proyecto;


      for ($a=0; $a<count($input['adicional']['valor']); $a++){

            if (!empty($input['adicional']['valor'][$a]) &&
                !empty($input['adicional']['detalle'][$a])) {

                  $datos1['valor'] = str_replace(',','',$input['adicional']['valor'][$a]);
                  $datos1['detalle'] = ucfirst($input['adicional']['detalle'][$a]);
                  $datos1['administrativa_id'] = $input['codigo_proyecto'];

                  Valor_adicional::create($datos1);

                  $adicionales = Valor_adicional::all();
                  $last_id = $adicionales->last()->id;
                  $administrativa = Administrativa::find($id);
                  $reg_adicional = Valor_adicional::find($last_id);

                  $total = $administrativa->saldo + $reg_adicional->valor;
                  $administrativa->saldo = $total;
                  $administrativa->save();

                  $nuevo_total = $administrativa->valor_total_contrato + $reg_adicional->valor;
                  $administrativa->valor_total_contrato = $nuevo_total;
                  $administrativa->save();
            }
      }
      return redirect()->route('adicionales.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Valor_adicional  $valor_adicional
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Valor_adicional  $valor_adicional
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $ide = Administrativa::findOrFail($id);
      $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
      return view('adicionales.edit',compact('adicionales','id','ide'));

      // $input = $request->all();
      //
      // for ($a=0; $a<count($input['adicional']['valor']); $a++){
      //
      //   $adicional = Valor_adicional::findOrFail($request->adicional['id'][$a]);
      //
      //   $datos['valor'] = $input['adicional']['valor'][$a];
      //   $datos['detalle'] = $input['adicional']['detalle'][$a];
      //
      //   $adicional->update($datos);
      //
      // }

      Session::flash('message', 'Valor adicional editado!');
      Session::flash('class', 'success');
      return redirect()->route('adicional.create');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Valor_adicional  $valor_adicional
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
      $input = $request->all();

      $datos['valor'] = str_replace(',','',$input['adicional']['valor']);

      // $adicional = Valor_adicional::findOrFail($id);
      // $administrativa = Administrativa::findOrFail($adicional->administrativa_id);

      for ($a=0; $a<count($input['adicional']['valor']); $a++){

        $datos['valor'] = str_replace(',','',$input['adicional']['valor'][$a]);
        $datos['detalle'] = ucfirst($input['adicional']['detalle'][$a]);

        $adicional = Valor_adicional::findOrFail($request->adicional['id'][$a]);
        $administrativa = Administrativa::findOrFail($adicional->administrativa_id);

        if ($administrativa->saldo < $adicional->valor) {
          Session::flash('message', 'El valor adicional no se puede editar ya que se efectuaron los pagos');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');
        }
        if ($administrativa->valor_total_contrato >= $datos['valor']) {

          $valor1 = $administrativa->valor_total_contrato - $adicional->valor;
          $valor2 = $valor1 + $datos['valor'];
          $administrativa->valor_total_contrato = $valor2;
          $administrativa->save();
          // $adicional->update($datos);


        }else {

          $valor1 = $administrativa->valor_total_contrato - $adicional->valor_tot;
          $valor2 = $valor1 + $datos['valor'];
          $administrativa->valor_total_contrato = $valor2;
          $administrativa->save();
          // $adicional->update($datos);

        }


        if ( $administrativa->saldo > 0) {

          if ($administrativa->saldo >= $datos['valor']) {
            $resta = $administrativa->saldo - $adicional->valor;
            $nuevo_saldo = $resta + $datos['valor'];
            $administrativa->saldo = $nuevo_saldo;
            $administrativa->save();
            // $adicional->update($datos);

          }
          else {
            $resta =$adicional->valor - $administrativa->saldo;
            $nuevo_saldo = $resta + $datos['valor'];
            $administrativa->saldo = $nuevo_saldo;
            $administrativa->save();
            // $adicional->update($datos);

          }

        }


        $adicional->update($datos);

      }

      Session::flash('message', 'Valor adicional editado!');
      Session::flash('class', 'success');
      return redirect()->route('administrativas.index');

      // return redirect()->route('administrativas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Valor_adicional  $valor_adicional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $adicional = Valor_adicional::findOrFail($id);
      $administrativas = Administrativa::findOrFail($adicional->administrativa_id);

      if ($administrativas->saldo < $adicional->valor) {
        Session::flash('message', 'El valor adicional no se puede eliminar ya que se efectuaron los pagos');
        Session::flash('class', 'danger');
        return redirect()->route('administrativas.index');
      }

      if ($administrativas->saldo > 0) {
        if ($administrativas->saldo > $adicional->valor) {
          $nuevo_saldo = $administrativas->saldo - $adicional->valor;
          $administrativas->saldo = $nuevo_saldo;
          $administrativas->save();
        }else {
          $nuevo_saldo = $adicional->valor - $administrativas->saldo;
          $administrativas->saldo = $nuevo_saldo;
          $administrativas->save();
        }

        if ($administrativas->valor_total_contrato > $adicional->valor) {
          $nuevo_total = $administrativas->valor_total_contrato - $adicional->valor;
          $administrativas->valor_total_contrato = $nuevo_total;
          $administrativas->save();
        }else {
          $nuevo_total = $adicional->valor - $administrativas->valor_total_contrato;
          $administrativas->valor_total_contrato = $nuevo_total;
          $administrativas->save();
        }
      }else {
        if ($administrativas->valor_total_contrato > $adicional->valor) {
          $nuevo_total = $administrativas->valor_total_contrato - $adicional->valor;
          $administrativas->valor_total_contrato = $nuevo_total;
          $administrativas->save();
        }else {
          $nuevo_total = $adicional->valor - $administrativas->valor_total_contrato;
          $administrativas->valor_total_contrato = $nuevo_total;
          $administrativas->save();
        }
      }

      $adicional->delete();

      Session::flash('message', 'Valor adicional eliminado');
      Session::flash('class', 'danger');
      return redirect()->route('administrativas.index');


    }
}
