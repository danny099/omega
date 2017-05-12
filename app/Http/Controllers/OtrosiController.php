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
      $id = $request->codigo_proyecto;
      $administrativa = Administrativa::find($id);

      foreach ($request->otrosi as $otro)
       {
         Otrosi::create(['valor'=>$otro,'administrativa_id'=>$id]);
         $other = Otrosi::all();
         $last_id = $other->last()->id;
         $reg_otro = Otrosi::find($last_id);

         $nuevo_saldo = $administrativa->saldo + $reg_otro->valor;
         $administrativa->saldo = $nuevo_saldo;
         $administrativa->save();
       }

       return redirect()->route('administrativas.index');

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
        $resta = $administrativa->saldo - $otrosi->valor;
        $nuevo_saldo = $resta + $request->valor;
        $administrativa->saldo = $nuevo_saldo;
        $administrativa->save();
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
      $nuevo_saldo = $administrativas->saldo - $otrosi->valor;
      $administrativas->saldo = $nuevo_saldo;
      $administrativas->save();
      $otrosi->delete();

      Session::flash('message', 'Otro si eliminado');
      Session::flash('class', 'danger');
      return redirect('administrativas');
;
    }
}
