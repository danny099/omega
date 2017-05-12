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
      $administrativa = Administrativa::find($id);

      for ($a=0; $a<count($input['adicional']['valor']); $a++){

            if (!empty($input['adicional']['valor'][$a]) &&
                !empty($input['adicional']['detalle'][$a])) {

                  $datos1['valor'] = $input['adicional']['valor'][$a];
                  $datos1['detalle'] = $input['adicional']['detalle'][$a];
                  $datos1['administrativa_id'] = $input['codigo_proyecto'];

                  Valor_adicional::create($datos1);

                  $adicionales = Valor_adicional::all();
                  $last_id = $adicionales->last()->id;
                  $reg_adicional = Valor_adicional::find($last_id);

                  $nuevo_saldo = $administrativa->saldo + $reg_adicional->valor;
                  $administrativa->saldo = $nuevo_saldo;
                  $administrativa->save();
            }
      }
      return redirect()->route('administrativas.index');

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
      $ide = Administrativa::find($id);
      $adicional = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();

      // dd($transformaciones);
      // die();
      return view('adicionales.edit',compact('adicional','id','ide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Valor_adicional  $valor_adicional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $input = $request->all();

      $adicional = Valor_adicional::findOrFail($id);
      $adicional->update($input);

      Session::flash('message', 'registro editado editado!');
      Session::flash('class', 'success');
      return redirect()->route('administrativas.index');
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
      $adicional->delete();

      Session::flash('message', 'Valor adicional eliminado');
      Session::flash('class', 'danger');
      return redirect();
    }
}
