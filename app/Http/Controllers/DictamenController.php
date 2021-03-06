<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Administrativa;
use App\Dictamen;
use App\Inspector;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;


class DictamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Administrativa::all();
        $var = Dictamen::distinct()->get(['administrativa_id']);

        foreach ($var as $key => $value) {

            $dictamenes[] = Administrativa::findOrFail($value->administrativa_id);

        }

        return view('dictamenes.index',compact('dictamenes','contratos'));
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

        $inspectores = Inspector::all();

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

        return view('dictamenes.create',compact('inspectores','contrato','cantidad_t','cantidad_dm','cantidad_db','pu_final','dictaminado_t','dictaminado_dm','dictaminado_db','dic_casas','dic_aparta','dic_zonas','dic_locales','dic_bodegas','dic_fijos'));
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

        for ($i=0; $i < count($input['dictamenes']['inspector']); $i++) { 

            $dictamen['matricula'] = $input['dictamenes']['matricula'][$i];
            $dictamen['director_tec'] = $input['dictamenes']['director'][$i];
            $dictamen['matricula_tec'] = $input['dictamenes']['matricula_dir'][$i];
            $dictamen['codigo_dic'] = $input['dictamenes']['codigo'][$i];
            $dictamen['proceso_dic'] = $input['dictamenes']['proceso'][$i];
            $dictamen['cantidad'] = $input['dictamenes']['cantidad'][$i];
            $dictamen['equipo'] = $input['dictamenes']['equipo'][$i];
            $dictamen['fecha_des'] = $input['dictamenes']['fecha_des'][$i];
            $dictamen['fecha_has'] = $input['dictamenes']['fecha_has'][$i];
            $dictamen['fecha_auto'] = $input['dictamenes']['fecha_auto'][$i];
            $dictamen['administrativa_id'] = $request->codigo;
            $dictamen['inspectores_id'] = $input['dictamenes']['inspector'][$i];

            Dictamen::create($dictamen);


        }

        Session::flash('message', 'Dictamenes creados');
        Session::flash('class', 'success');
        return redirect('dictamenes');

    }

    public function añadirDictamen(){

        $cantidad_t = 0;
        $cantidad_dm = 0;
        $cantidad_db = 0;

        $inspectores = Inspector::all();

        $contratos = Administrativa::all();
       

        return view('dictamenes.añadirDictamen',compact('inspectores','contratos'));

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
        $cantidad_t = 0;
        $cantidad_dm = 0;
        $cantidad_db = 0;

        $dictamenes = Dictamen::where('dictamenes.administrativa_id','=',$id)->get();
        $inspectores = Inspector::all();

        $contrato = Administrativa::findOrFail($id);
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

        return view('dictamenes.edit',compact('dictamenes','inspectores','cantidad_t','cantidad_dm','cantidad_db','pu_final','dictaminado_t','dictaminado_dm','dictaminado_db','dic_casas','dic_aparta','dic_zonas','dic_locales','dic_bodegas','dic_fijos'));
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
        $input = $request->all();

        for ($i=0; $i < count($input['dictamenes']['dictamen_id']); $i++) { 
            
            $dictamen = Dictamen::findOrFail($input['dictamenes']['dictamen_id'][$i]);

            $datos['matricula'] = $input['dictamenes']['matricula'][$i];
            $datos['director_tec'] = $input['dictamenes']['director'][$i];
            $datos['matricula_tec'] = $input['dictamenes']['matricula_dir'][$i];
            $datos['codigo_dic'] = $input['dictamenes']['codigo'][$i];
            $datos['proceso_dic'] = $input['dictamenes']['proceso'][$i];
            $datos['cantidad'] = $input['dictamenes']['cantidad'][$i];
            $datos['equipo'] = $input['dictamenes']['equipo'][$i];
            $datos['fecha_des'] = $input['dictamenes']['fecha_des'][$i];
            $datos['fecha_has'] = $input['dictamenes']['fecha_has'][$i];
            $datos['fecha_auto'] = $input['dictamenes']['fecha_auto'][$i];
            $datos['inspectores_id'] = $input['dictamenes']['inspector'][$i];

            $dictamen->update($datos);


        }

        Session::flash('message', 'Dictamenes editados');
        Session::flash('class', 'success');
        return redirect('dictamenes');
        
    }

    public function eliminar($id){

        $dictamen = Dictamen::findOrFail($id);

        $dictamen->delete();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dictamenes = Dictamen::where('dictamenes.administrativa_id','=',$id)->get();

        foreach ($dictamenes as $key => $dic) {
            
            $registro = Dictamen::findOrFail($dic->id);
            $registro->delete();
        }

        Session::flash('message', 'Dictamen eliminado');
        Session::flash('class', 'danger');
        return redirect('dictamenes');
    }
}
