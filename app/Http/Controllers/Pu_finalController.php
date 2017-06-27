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
           if (!is_null($input['pu_final']['descripcion_pu'][$i]) &&
               !is_null($input['pu_final']['tipo_pu'][$i]) &&
               !is_null($input['pu_final']['estrato_pu'][$i]) &&
               !is_null($input['pu_final']['cantidad_pu'][$i]) &&
               !is_null($input['pu_final']['metros_pu'][$i]) &&
               !is_null($input['pu_final']['kva_pu'][$i])  &&
               !is_null($input['pu_final']['acometidas_pu'][$i])) {

                 $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
                 $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
                 $datos3['estrato'] = $input['pu_final']['estrato_pu'][$i];
                 $datos3['unidad'] = 'Und';
                 $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
                 $datos3['metros'] = $input['pu_final']['metros_pu'][$i];

                 if ($input['pu_final']['kva_pu'][$i] == 0) {

                   $datos3['kva'] = 'Según Plano';

                 }else {
                   $datos3['kva'] = $input['pu_final']['kva_pu'][$i];
                 }

                 $datos3['acometidas'] = $input['pu_final']['acometidas_pu'][$i];
                 $datos3['administrativa_id'] = $request->codigo_proyecto;

                 Pu_final::create($datos3);

           }
       }
       Session::flash('message', 'Alcance proceso de uso final creado!');
       Session::flash('class', 'success');
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
     public function editar(Request $request)
     {
       $input = $request->all();

       for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {

         $pu = Pu_final::findOrFail($request->pu_final['id'][$i]);
         $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
         $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
         $datos3['estrato'] = $input['pu_final']['estrato_pu'][$i];
         $datos3['unidad'] = 'Und';
         $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
         $datos3['metros'] = $input['pu_final']['metros_pu'][$i];

         if ($input['pu_final']['kva_pu'][$i] == 0) {

           $datos3['kva'] = 'Según Plano';

         }else {
           $datos3['kva'] = $input['pu_final']['kva_pu'][$i];
         }

         $datos3['acometidas'] = $input['pu_final']['acometidas_pu'][$i];

         $pu->update($datos3);

       }
       Session::flash('message', 'Alcance de proceso de uso final editado!');
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
      Session::flash('message', 'Alcance proceso de uso final eliminado');
      Session::flash('class', 'danger');
      return redirect()->route('administrativas.index');

    }
}
