<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacion;
use App\Administrativa;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;
class AutorizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $contratos = Administrativa::all();        
        $var = Autorizacion::distinct()->get(['administrativa_id']);

        foreach ($var as $key => $value) {

            $autorizados[] = Administrativa::findOrFail($dato->administrativa_id);

        }

        return view('autorizacion.index',compact('autorizados','contratos'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cantida_t = 0;
        $cantida_dm = 0;
        $cantida_db = 0;
        // $cantida_pu = 0;

        $contrato = Administrativa::findOrFail($request->codigo_con);        
        $t = Transformacion::where('transformacion.administrativa_id', '=', $contrato->id)->get();
        $dm = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->where('descripcion','like','%MT%')->get();
        $db = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->where('descripcion','like','%BT%')->get();
        $pu_final = Pu_final::where('pu_final.administrativa_id', '=', $contrato->id)->get();

        foreach ($t as $key => $trans) {

            $cantidad_t = $cantidad_t + $trans->cantidad;

        }
        foreach ($dm as $key => $media) {
            $cantidad_dm = $cantidad_dm + $media->cantidad;
        }
        foreach ($db as $key => $baja) {
            $cantidad_db = $cantidad_db + $baja->cantidad;
        }
        // foreach ($pu as $key => $pu_final) {
        //     $cantidad_pu = cantidad_pu + $pu_final->cantidad;
        // }
        
        return view('autorizacion.create',compact('cantidad_t','cantidad_dm','cantidad_db','pu_final'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
