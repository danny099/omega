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
        // $id_contrato = $id;
        $descripciones = Descripcion::where('descripcion.administrativa_id','=',$id)->get();


        return view('ncObra.edit',compact('descripciones'));
        
    }

    public function ncs($id){

        $ncs[] = Nc::where('nc.descripcion_id','=',$id)->get();

        return $ncs;

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
        $fecha = $now->format('Y-m-d');

        $conta = count($request->descripcion_id);

        for ($i=1; $i <= $conta; $i++) { 
            
            $dato = Descripcion::findOrFail($request->descripcion_id[$i]);
            $dato->fecha = $fecha;

            $dato->save();
                  
        }

        for ($x=0; $x < count($request->nc_id); $x++) { 
                
            for ($y=0; $y < count($request->nc_id[$x]); $y++) { 
                
                $dato2 = Nc::findOrFail($request->nc_id[$x][$y]);
                $dato2->nc = $request->nc[$x][$y];
                $dato2->save();

            }
                
        }

        Session::flash('message', 'No conformidad Editada');
        Session::flash('class', 'success');
        return redirect('ncObra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descripciones = Descripcion::where('descripcion.administrativa_id','=',$id)->get();
        
        foreach ($descripciones as $key => $values) {

            $regs = Descripcion::findOrFail($values->id);
            $ncs = Nc::where('nc.descripcion_id','=',$regs->id)->get();

            foreach ($ncs as $key => $var) {
                
                $registro = Nc::findOrFail($var->id);
                $registro->delete();
            }

            $regs->delete();
        }

        Session::flash('message', 'No conformidad eliminada');
        Session::flash('class', 'danger');
        return redirect('ncObra');
    }
}
