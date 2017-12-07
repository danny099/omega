<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Descripcion;
use App\Administrativa;
class DescripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Administrativa::all();
        $var = Descripcion::distinct()->get(['administrativa_id']);

        foreach ($var as $key => $dato) {

            $descripciones[] = Administrativa::findOrFail($dato->administrativa_id);

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
        $id = $request->codigo_con;
        $contrato = Administrativa::findOrFail($id);
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
        $descripcion = Descripcion::where('descripcion.administrativa_id','=',$id);
        $noconformidades = Nc::where('nc.descripcion_id','=',$descripcion->id);
        return view('ncObra.edit',compact('noconformidades'));
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
