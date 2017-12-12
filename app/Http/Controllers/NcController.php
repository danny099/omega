<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrativa;
use App\Descripcion;
use App\Nc;
use Session;

class NcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Administrativa::all();
        $des = Descripcion::distinct()->get(['administrativa_id']);

        foreach ($des as $key => $value) {

            $descripciones[] = Administrativa::findOrFail($value->administrativa_id);

        }


        return view('ncObra.index',compact('descripciones','contratos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $contrato = Administrativa::findOrFail($request->codigo_con);
        return view('ncObra.create',compact('contrato'));    
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
        // dd($input);
        // die();
        $now = new \DateTime();
        $fecha = $now->format('Y-m-d');

        $conta = count($request->nc);

        for ($i=1; $i <= $conta; $i++) { 
            
            $descripcion['descripcion'] = $request->descripcion[$i];
            $descripcion['fecha'] = $fecha;
            $descripcion['administrativa_id'] = $request->codigo_con;

            Descripcion::create($descripcion);
          

            $des = Descripcion::all();
            $lastId_des = $des->last()->id;

            for ($x=0; $x < count($request->nc[$i]); $x++) { 
                
                $ncs['nc'] = $request->nc[$i][$x];
                $ncs['descripcion_id'] = $lastId_des;

                Nc::create($ncs);
                
            }
        }

        Session::flash('message', 'No conformidad creada');
        Session::flash('class', 'success');
        return redirect('ncObra');

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
