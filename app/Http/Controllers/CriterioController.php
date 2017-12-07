<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Criterio;
use App\Administrativa;
use App\Item;
use Session;

class Fechas{
    public static function dater($x) {
       $year = substr($x, 0, 4);
       $mon = substr($x, 5, 2);
       switch($mon) {
          case "01":
             $month = "Enero";
             break;
          case "02":
             $month = "Febrero";
             break;
          case "03":
             $month = "Marzo";
             break;
          case "04":
             $month = "Abril";
             break;
          case "05":
             $month = "Mayo";
             break;
          case "06":
             $month = "Junio";
             break;
          case "07":
             $month = "Julio";
             break;
          case "08":
             $month = "Agosto";
             break;
          case "09":
             $month = "Septiembre";
             break;
          case "10":
             $month = "Octubre";
             break;
          case "11":
             $month = "Noviembre";
             break;
          case "12":
             $month = "Diciembre";
             break;
       }
       $day = substr($x, 8, 2);
       return $day." de ".$month." del ".$year;
    }
}
class CriterioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($tipo)
    {

        $contratos = Administrativa::all();
        $var = Criterio::distinct()->where('criterios.tipo',$tipo)->get(['administrativa_id']);

        foreach ($var as $key => $dato) {

            $criterios[] = Administrativa::findOrFail($dato->administrativa_id);

        }

        //$criterios = Administrativa::findOrFail($dato);

        return view($tipo.'.index',compact('criterios','contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$tipo)
    {

        $items = Item::where('items.tipo', '=', $tipo)->get();
        $now = new \DateTime();
        $fech = $now->format('Y-m-d');
        $fecha = Fechas::dater($fech);

        $contrato = Administrativa::findOrFail($request->codigo_con);
        return view($tipo.'.create',compact('items','contrato','fecha'));
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
        $fech = $now->format('Y-m-d');
        $fecha = Fechas::dater($fech);
        $var = count($input['tipo']);


        for ($i=0; $i < $var; $i++) {

            if (isset($input['aplica'][$i][$i])) {
                $datos['aplica'] =  $input['aplica'][$i][$i];
            }else{
                $datos['aplica'] =  null;               
            }


            if (isset($input['cumple'][$i][$i])) {
                $datos['cumple'] =  $input['cumple'][$i][$i];
            }else{
                $datos['cumple'] =  null;            
            }

            if (isset($input['observaciones'][$i][$i])) {
                $datos['observaciones'] =  $input['observaciones'][$i][$i];
            }else{
                $datos['observaciones'] =  null;                
            }

            $datos['tipo'] = $input['tipo'][$i];
            $datos['fecha'] = $fecha;
            $datos['administrativa_id'] = $input['id'][$i];
            $datos['items_id'] = $input['iditem'][$i];

            
            Criterio::create($datos);

        }
        Session::flash('message', 'Detalle creado');
        Session::flash('class', 'success');
        return redirect('criterio/'.$input['tipo'][0]);



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
    public function edit($id,$tipo)
    {
        $criterios = Criterio::where('criterios.administrativa_id', '=', $id)->where('criterios.tipo','=',$tipo)->get();

        foreach ($criterios as $key => $value) {

            $tipo2[] = $value->tipo;
        }

        
      
        $items = Item::where('items.tipo', '=', $tipo2[0])->get();

       
        return view($tipo2[0].'.edit',compact('criterios','items'));

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
        // dd($input);
        // die();
        $now = new \DateTime();
        $fech = $now->format('Y-m-d');
        $fecha = Fechas::dater($fech);
       
        $var = count($input['id_criterio']);

        for ($i=0; $i < count($input['id_criterio']); $i++) {

            if (isset($input['aplica'][$i][$i])) {
                $datos['aplica'] =  $input['aplica'][$i][$i];
            }

            if (isset($input['cumple'][$i][$i])) {
                $datos['cumple'] =  $input['cumple'][$i][$i];
            }

            $datos['observaciones'] =  $input['observaciones'][$i][$i];
            $datos['fecha'] = $fecha;

            $criterio = Criterio::findOrFail($input['id_criterio'][$i]);
            $criterio->update($datos);


        }

        Session::flash('message', 'Detalle editado');
        Session::flash('class', 'success');
        return redirect('criterio/'.$input['tipo'][0]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$tipo)
    {

        $criterios = Criterio::where('criterios.administrativa_id', '=', $id)->where('criterios.tipo','=',$tipo)->get();

        foreach ($criterios as $key => $val) {
            $tips[]= $val->tipo;
        }
        foreach ($criterios as $key => $value) {           
           $value->delete();
        }   

        Session::flash('message', 'Detalle eliminado');
        Session::flash('class', 'danger');
        return redirect('criterio/'.$tipo);
        
    }
}
