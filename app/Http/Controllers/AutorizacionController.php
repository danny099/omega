<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacion;
use App\Administrativa;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;
use App\Dictamen;
use App\Cantidad_autorizada;
use Session;

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

        if (count($var) > 0) {

            foreach ($var as $key => $datico) {
            
                $idc[] = $datico->administrativa_id;
             }

             $id = $idc[0];
        }else{
            $id = null;
        }
        


        return view('autorizacion.index',compact('autorizados','contratos','id'));
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

        $dictaminado_t = 0;
        $dictaminado_dm = 0;
        $dictaminado_db  = 0;
        $dictaminado_pu = 0;
        $dic_casas = 0;
        $dic_aparta = 0;
        $dic_zonas = 0;
        $dic_locales = 0;
        $dic_bodegas = 0;
        $dic_fijos = 0;

        $dicataminado = Dictamen::where('administrativa_id','=',$contrato->id)->get();

        foreach ($dicataminado as $key => $dic) {
            
            if ($dic->proceso_dic == 'Transformacion') {
                
                $dictaminado_t = $dictaminado_t + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red MT (m)') {
                $dictaminado_dm = $dictaminado_dm + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red BT (m)') {
               $dictaminado_db = $dictaminado_db + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Casas') {
               $dic_casas = $dic_casas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Apartamentos') {
               $dic_aparta = $dic_aparta + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Zonas comunes') {
               $dic_zonas = $dic_zonas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Locales comerciales') {
               $dic_locales = $dic_locales + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Bodegas') {
               $dic_bodegas = $dic_bodegas + $dic->cantidad;
            }
            if ($dic->proceso_dic == 'Puntos fijos') {
               $dic_fijos = $dic_fijos + $dic->cantidad;
            }
        }


        return view('autorizacion.create',compact('cantidad_t','cantidad_dm','cantidad_db','pu_final','contrato','cantidad_contratada','dictaminado_t','dictaminado_dm','dictaminado_db','dic_casas','dic_aparta','dic_zonas','dic_locales','dic_bodegas','dic_fijos'));
    }

    public function getMatricula(Request $request){

       $data = Ispector::select('matricual','id')->where('inspectores.id',$request->id)->get();
       dd($data);
       die();
       return response()->json($data);
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
            if ($autorizacion1['firma'] == null) {
                $autorizacion1['fecha'] = null;
            }else{
                $autorizacion1['fecha'] = $fecha; 
            }
                   
            $autorizacion1['administrativa_id'] = $request->administrativa_id;        
            $autorizacion1['cantidad_autorizada_id'] = $lastId_cant;    

            Autorizacion::create($autorizacion1);

        // }

        // if (!empty($request->nombre_director) && !empty($request->firma_director) && !empty($request->obs_director)) {

            $autorizacion2['autorizado'] = $request->nombre_director;
            $autorizacion2['firma'] = $request->firma_director;
            $autorizacion2['observaciones'] = $request->obs_director;
            if ($autorizacion2['firma'] == null) {
                $autorizacion2['fecha'] = null;
            }else{
                $autorizacion2['fecha'] = $fecha; 
            }
               
            $autorizacion2['administrativa_id'] = $request->administrativa_id;      
            $autorizacion2['cantidad_autorizada_id'] = $lastId_cant;      
            
            Autorizacion::create($autorizacion2);

        // }
        
        // if (!empty($request->nombre_administrativa) && !empty($request->firma_administrativa) && !empty($request->obs_administrativa)) {

            $autorizacion3['autorizado'] = $request->nombre_administrativa;
            $autorizacion3['firma'] = $request->firma_administrativa;
            $autorizacion3['observaciones'] = $request->obs_administrativa;
            if ($autorizacion3['firma'] == null) {
                $autorizacion3['fecha'] = null;
            }else{
                $autorizacion3['fecha'] = $fecha; 
            }            
            $autorizacion3['administrativa_id'] = $request->administrativa_id;        
            $autorizacion3['cantidad_autorizada_id'] = $lastId_cant;        

            Autorizacion::create($autorizacion3);

        // }

        

        // if (!empty($request->nombre_general) && !empty($request->firma_general) && !empty($request->obs_general)) {

            $autorizacion4['autorizado'] = $request->nombre_general;
            $autorizacion4['firma'] = $request->firma_general;
            $autorizacion4['observaciones'] = $request->obs_general;
            if ($autorizacion4['firma'] == null) {
                $autorizacion4['fecha'] = null;
            }else{
                $autorizacion4['fecha'] = $fecha; 
            }            
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

            Autorizacion::create($autorizacion5);

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
        $id_contrato = $id;
        $autorizados = Autorizacion::where('autorizacion.administrativa_id','=',$id)->get();
        
        foreach ($autorizados as $key => $valu) {
            $idc[] = $valu->cantidad_autorizada_id;
        }

        $nombres = array('Jhon Jairo Escobar Segura','Jairo Ivan Ibarra Ruales','Alejandra Vitali','Juan Manuel Leon S.','Oscar Andres Sanclemente R');

        $cargos = array('Jefe de poyectos','Director tecnico','Gerente administrativa','Gerente general','Presidente');

        $cantidades = Cantidad_autorizada::findOrFail($idc[0]);

        $dictaminado_t = 0;
        $dictaminado_dm = 0;
        $dictaminado_db  = 0;
        $dictaminado_pu = 0;
        $dic_casas = 0;
        $dic_aparta = 0;
        $dic_zonas = 0;
        $dic_locales = 0;
        $dic_bodegas = 0;
        $dic_fijos = 0;

        $dicataminado = Dictamen::where('administrativa_id','=',$id_contrato)->get();

        foreach ($dicataminado as $key => $dic) {
            
            if ($dic->proceso_dic == 'Transformacion') {
                
                $dictaminado_t = $dictaminado_t + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red MT (m)') {
                $dictaminado_dm = $dictaminado_dm + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red BT (m)') {
               $dictaminado_db = $dictaminado_db + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Casas') {
               $dic_casas = $dic_casas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Apartamentos') {
               $dic_aparta = $dic_aparta + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Zonas comunes') {
               $dic_zonas = $dic_zonas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Locales comerciales') {
               $dic_locales = $dic_locales + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Bodegas') {
               $dic_bodegas = $dic_bodegas + $dic->cantidad;
            }
            if ($dic->proceso_dic == 'Puntos fijos') {
               $dic_fijos = $dic_fijos + $dic->cantidad;
            }
        }
        
        return view('autorizacion.edit',compact('autorizados','cantidades','nombres','cargos','id_contrato','dictaminado_t','dictaminado_dm','dictaminado_db','dic_casas','dic_aparta','dic_zonas','dic_locales','dic_bodegas','dic_fijos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $now = new \DateTime();
        $fecha = $now->format('Y-m-d');

        $input = $request->all();        
        $id_auto = $request->id_auto;
        $nombre = $request->nombre;
        $firma = $request->firma;
        $observaciones = $request->observaciones;
        for ($i=0; $i < count($id_auto); $i++) { 
            
            $registro1 = Autorizacion::findOrFail($id_auto[$i]);

            $datos['autorizado'] = $nombre[$i];
            $datos['firma'] = $firma[$i];
            $datos['observaciones'] = $observaciones[$i];
            $datos['fecha'] = $fecha;

            $registro1->update($datos);
        }

        $cantidad = Cantidad_autorizada::findOrFail($request->id_cantidades);

        if (isset($request->transformacion)) {
            $datos2['transformacion'] = $request->transformacion;
            # code...
        }else{
            $datos2['transformacion'] = null;
        }

        if (isset($request->red_mt)) {
            $datos2['red_mt'] = $request->red_mt;
        }else{
            $datos2['red_mt'] = null;            
        }

        if (isset($request->red_bt)) {
            $datos2['red_bt'] = $request->red_bt;
        }else{
            $datos2['red_bt'] = null;
        }

        if (isset($request->casas)) {
            $datos2['casas'] = $request->casas;
        }else{
            $datos2['casas'] = null;            
        }

        if (isset($request->apartamentos)) {
            $datos2['apartamentos'] = $request->apartamentos;            
        }else{
            $datos2['apartamentos'] = null;
        }

        if (isset($request->zonas)) {
            $datos2['zonas'] = $request->zonas;
        }else{
            $datos2['zonas'] = null;
        }

        if (isset($request->locales)) {
            $datos2['locales'] = $request->locales;
        }else{
            $datos2['locales'] = null;
        }

        if (isset($request->bodegas)) {
            $datos2['bodegas'] = $request->bodegas;
        }else{
            $datos2['bodegas'] = null;
        }

        if (isset($request->puntos_fijos)) {
            $datos2['puntos_fijos'] = $request->puntos_fijos;
        }else{
            $datos2['puntos_fijos'] = null;
        }

        $cantidad->update($datos2);

        Session::flash('message', 'Autorizacion editada');
        Session::flash('class', 'success');
        return redirect('autorizacion');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autorizados = Autorizacion::where('autorizacion.administrativa_id','=',$id)->get();

        foreach ($autorizados as $key => $auto) {
            
            $registro = Autorizacion::findOrFail($auto->id);

            $registro->delete();
        }

        Session::flash('message', 'Autorizacion eliminado');
        Session::flash('class', 'danger');
        return redirect('autorizacion');
    }
}
