<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Criterio;
use App\Administrativa;
use App\Item;
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

      
        for ($i=0; $i < count($input['tipo']); $i++) { 
           
            if (isset($input['aplica'][$i][$i])) {
                $datos['aplica'] =  $input['aplica'][$i][$i];
            }

            if (isset($input['cumple'][$i][$i])) {
                $datos['cumple'] =  $input['cumple'][$i][$i];
            }

            if (isset($input['observaciones'][$i][$i])) {
                $datos['observaciones'] =  $input['observaciones'][$i][$i];
            }
            $datos['tipo'] = $input['tipo'][$i];
            $datos['administrativa_id'] = $input['id'][$i];
            $datos['items_id'] = $input['iditem'][$i];


            Criterio::create($datos);

        }
        
        return redirect()->route($input['tipo'][0].'administrativas.index');
        

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
        $criterios = Criterio::where('criterios.administrativa_id', '=', $id)->get();
        
        foreach ($criterios as $key => $value) {
            
            $tipo[] = $value->tipo;
        }

        $items = Item::where('items.tipo', '=', $tipo[0])->get();

        
        return view('disDeta.edit',compact('criterios','items'));
        
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
        //dd($input['observaciones']);
        //die();
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
