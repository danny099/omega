<?php

namespace App\Http\Controllers;
use App\Otrosi;
use Session;
use App\Administrativa;
use Illuminate\Http\Request;

class OtrosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $otrosis=Otrosi::all();

      return view('otrosi.index',compact('otrosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $otrosi = Otrosi::all();
      $codigos = Administrativa::all();

      return view('otrosi.create',compact('codigos'));
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

      $id = $request->administrativa_id;


      Otrosi::create($input);

      $other = Otrosi::all();
      $last_id = $other->last()->id;
      $reg_otro = Otrosi::find($last_id);
      $administrativa = Administrativa::find($id);

      $administrativa->recordar = $request->recordarme;
      $administrativa->save();

      $total = $administrativa->saldo + $reg_otro->valor_tot;
      $administrativa->saldo = $total;
      $administrativa->save();

      $nuevo_total = $administrativa->valor_total_contrato + $reg_otro->valor_tot;
      $administrativa->valor_total_contrato = $nuevo_total;
      $administrativa->save();

      Session::flash('message', 'Otro si creado!!');
      Session::flash('class', 'success');
      return redirect()->route('otrosi.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
      $otrosi = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
      return view('otrosi.edit',compact('otrosi','id','ide'));
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

      $otrosi = Otrosi::findOrFail($id);
      $administrativa = Administrativa::findOrFail($otrosi->administrativa_id);

      if ( $administrativa->saldo > 0) {
        if ($administrativa->saldo > $otrosi->valor) {
          $resta = $administrativa->saldo - $otrosi->valor;
          $nuevo_saldo = $resta + $request->valor;
          $administrativa->saldo = $nuevo_saldo;
          $administrativa->save();
        }
        else {
          $resta = $otrosi->valor - $administrativa->saldo ;
          $nuevo_saldo = $resta + $request->valor;
          $administrativa->saldo = $nuevo_saldo;
          $administrativa->save();
        }

      }

      $otrosi->update($input);

      Session::flash('message', 'registro editado editado!');
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
      $otrosi = Otrosi::findOrFail($id);
      $administrativas = Administrativa::findOrFail($otrosi->administrativa_id);

      $flag = 1;

      $administrativas->recordar = $flag;

      $administrativas->save();

      $nuevo_saldo = $administrativas->saldo - $otrosi->valor;
      $administrativas->saldo = $nuevo_saldo;
      $nuevo_total = $administrativas->valor_total_contrato - $otrosi->valor;
      $administrativas->valor_total_contrato = $nuevo_total;
      $administrativas->save();
      $otrosi->delete();

      Session::flash('message', 'Otro si eliminado');
      Session::flash('class', 'danger');
      return redirect()->route('administrativas.index');

    }
}
