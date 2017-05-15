<?php

namespace App\Http\Controllers;
use App\Pu_final;
use Session;
use App\Administrativa;
use Illuminate\Http\Request;

class Pu_finalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pu_finales=Pu_final::all();

      return view('pu_final.index',compact('pu_finales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codigos = Administrativa::all();
        return view('pu_final.create',compact('codigos'));
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
       for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {
           if (!empty($input['pu_final']['descripcion_pu'][$i]) &&
               !empty($input['pu_final']['tipo_pu'][$i]) &&
               !empty($input['pu_final']['unidad_pu_final'][$i]) &&
               !empty($input['pu_final']['cantidad_pu'][$i])) {

                 $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
                 $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
                 $datos3['unidad'] = $input['pu_final']['unidad_pu_final'][$i];
                 $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
                 $datos3['administrativa_id'] = $input['codigo_proyecto'];

                 Pu_final::create($datos3);
           }
       }

       return redirect()->route('administrativas.index');

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
      $ide = Administrativa::findOrFail($id);
      $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
      return view('pu_final.edit',compact('pu_finales','id','ide'));
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
      $input = $request->all();

      $pu = Pu_final::findOrFail($id);
      $pu->update($input);

      Session::flash('message', 'registro editado editado!');
      Session::flash('class', 'success');
      return redirect()->route('administrativas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pu = Pu_final::findOrFail($id);
      $pu->delete();
      Session::flash('message', 'Alcance Transformacion eliminado');
      Session::flash('class', 'danger');
      return redirect();
    }
}
