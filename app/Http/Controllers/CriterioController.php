<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Criterio;
use App\Administrativa;
use App\Item;
use Session;

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

        $contrato = Administrativa::findOrFail($request->codigo_con);
        return view($tipo.'.create',compact('items','contrato'));
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
            $datos['administrativa_id'] = $input['id'][$i];
            $datos['items_id'] = $input['iditem'][$i];
            


            Criterio::create($datos);

        }

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
       
        $var = count($input['id_criterio']);

        for ($i=0; $i < count($input['id_criterio']); $i++) {

            if (isset($input['aplica'][$i][$i])) {
                $datos['aplica'] =  $input['aplica'][$i][$i];
            }

            if (isset($input['cumple'][$i][$i])) {
                $datos['cumple'] =  $input['cumple'][$i][$i];
            }

            $datos['observaciones'] =  $input['observaciones'][$i][$i];

            $criterio = Criterio::findOrFail($input['id_criterio'][$i]);
            $criterio->update($datos);


        }
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

        Session::flash('message', 'Criterio eliminado');
        Session::flash('class', 'danger');
        return redirect('criterio/'.$input['tipo'][0]);
        
    }
}
