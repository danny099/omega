<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacion;
use App\Administrativa;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;
use App\Cantidad_autorizada;
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

            $autorizados[] = Administrativa::findOrFail($value->administrativa_id);

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
        $cantidad_t = 0;
        $cantidad_dm = 0;
        $cantidad_db = 0;
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

        return view('autorizacion.create',compact('cantidad_t','cantidad_dm','cantidad_db','pu_final','contrato'));
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

        $now = new \DateTime();
        $fecha = $now->format('Y-m-d');

        if (isset($request->transformacion)) {
            $c_autorizada['transformacion'] = $request->transformacion;
            # code...
        }else{
            $c_autorizada['transformacion'] = null;
        }

        if (isset($request->red_mt)) {
            $c_autorizada['red_mt'] = $request->red_mt;
        }else{
            $c_autorizada['red_mt'] = null;            
        }

        if (isset($request->red_bt)) {
            $c_autorizada['red_bt'] = $request->red_bt;
        }else{
            $c_autorizada['red_bt'] = null;
        }

        if (isset($request->casas)) {
            $c_autorizada['casas'] = $request->casas;
        }else{
            $c_autorizada['casas'] = null;            
        }

        if (isset($request->apartamentos)) {
            $c_autorizada['apartamentos'] = $request->apartamentos;            
        }else{
            $c_autorizada['apartamentos'] = null;
        }

        if (isset($request->zonas)) {
            $c_autorizada['zonas'] = $request->zonas;
        }else{
            $c_autorizada['zonas'] = null;
        }

        if (isset($request->locales)) {
            $c_autorizada['locales'] = $request->locales;
        }else{
            $c_autorizada['locales'] = null;
        }

        if (isset($request->bodegas)) {
            $c_autorizada['bodegas'] = $request->bodegas;
        }else{
            $c_autorizada['bodegas'] = null;
        }

        if (isset($request->puntos_fijos)) {
            $c_autorizada['puntos_fijos'] = $request->puntos_fijos;
        }else{
            $c_autorizada['puntos_fijos'] = null;
        }
        

        Cantidad_autorizada::create($c_autorizada);
        
        $cant = Cantidad_autorizada::all();
        $lastId_cant = $cant->last()->id;
        $cant_autorizada = Cantidad_autorizada::findOrFail($cant);

        // if (!empty($request->nombre_jefe) && !empty($request->firma_jefe) && !empty($request->obs_jefe)) {
            
            $autorizacion1['autorizado'] = $request->nombre_jefe;
            $autorizacion1['firma'] = $request->firma_jefe;
            $autorizacion1['observaciones'] = $request->obs_jefe;
            $autorizacion1['fecha'] = $fecha;        
            $autorizacion1['administrativa_id'] = $request->administrativa_id;        
            $autorizacion1['cantidad_autorizada_id'] = $lastId_cant;    

            Autorizacion::create($autorizacion1);

        // }

        // if (!empty($request->nombre_director) && !empty($request->firma_director) && !empty($request->obs_director)) {

            $autorizacion2['autorizado'] = $request->nombre_director;
            $autorizacion2['firma'] = $request->firma_director;
            $autorizacion2['observaciones'] = $request->obs_director;
            $autorizacion2['fecha'] = $fecha;      
            $autorizacion2['administrativa_id'] = $request->administrativa_id;      
            $autorizacion2['cantidad_autorizada_id'] = $lastId_cant;      
            
            Autorizacion::create($autorizacion2);

        // }
        
        // if (!empty($request->nombre_administrativa) && !empty($request->firma_administrativa) && !empty($request->obs_administrativa)) {

            $autorizacion3['autorizado'] = $request->nombre_administrativa;
            $autorizacion3['firma'] = $request->firma_administrativa;
            $autorizacion3['observaciones'] = $request->obs_administrativa;
            $autorizacion3['fecha'] = $fecha;        
            $autorizacion3['administrativa_id'] = $request->administrativa_id;        
            $autorizacion3['cantidad_autorizada_id'] = $lastId_cant;        

            Autorizacion::create($autorizacion3);

        // }

        

        // if (!empty($request->nombre_general) && !empty($request->firma_general) && !empty($request->obs_general)) {

            $autorizacion4['autorizado'] = $request->nombre_general;
            $autorizacion4['firma'] = $request->firma_general;
            $autorizacion4['observaciones'] = $request->obs_general;
            $autorizacion4['fecha'] = $fecha;        
            $autorizacion4['administrativa_id'] = $request->administrativa_id;        
            $autorizacion4['cantidad_autorizada_id'] = $lastId_cant;        

            Autorizacion::create($autorizacion4);

        // }
        

        // if (!empty($request->nombre_presidente) && !empty($request->firma_presidente) && !empty($request->obs_presidente)) {

            $autorizacion5['autorizado'] = $request->nombre_presidente;
            $autorizacion5['firma'] = $request->firma_presidente;
            $autorizacion5['observaciones'] = $request->obs_presidente;
            $autorizacion5['fecha'] = $fecha;        
            $autorizacion5['administrativa_id'] = $request->administrativa_id;        
            $autorizacion5['cantidad_autorizada_id'] = $lastId_cant;        

            Autorizacion::create($autorizacion5autorizado);

        // }

        return redirect()->route('autorizacion.index');

        
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
        $autorizados = Autorizacion::where('autorizacion.administrativa_id','=',$id)->get();

        foreach ($autorizados as $key => $valu) {
            $idc[] = $valu->cantidad_autorizada_id;
        }

        $cantidades = Cantidad_autorizada::findOrFail($idc[0]);

        return view('autorizacion.edit',compact('autorizadas','cantidades'));
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
