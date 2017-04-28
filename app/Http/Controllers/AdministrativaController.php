<?php

namespace App\Http\Controllers;
use App\Administrativa;
use App\Cliente;
use App\Otrosi;
use App\Distribucion;
use App\Transformacion;
use App\Pu_final;
use Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class AdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $administrativas=Administrativa::all();
      $clientes=Cliente::all();
      $otrosis=Otrosi::all();
      $distribuciones=Distribucion::all();
      $transformaciones=Transformacion::all();
      $pu_finales=Pu_final::all();


      return view('administrativas.index',compact('administrativas','clientes','otrosis','distribuciones','transformaciones','pu_finales'));        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
   {
       $clientes=Cliente::all();
       $otrosis=Otrosi::all();
       $distribuciones=Distribucion::all();
       $transformaciones=Transformacion::all();
       $pu_finales=Pu_final::all();
       return view('administrativas.create',compact('clientes','otrosis','distribuciones','transformaciones','pu_finales'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
     $input = Request::all();


     /* -------------------------otrosi------------------------------*/
     $otrosi['valor'] = Request::input('otrosi');

     Otrosi::create($otrosi);
     $othetsi = Otrosi::all();
     $lastId_otrosi = $othetsi->last()->id;

     /* -------------------------proceso transformacion------------------------------*/
     $transformacion['descripcion'] = Request::input('descripcion');
     $transformacion['tipo'] = Request::input('tipo');
     $transformacion['capacidad'] = Request::input('capacidad');
     $transformacion['unidad'] = Request::input('unidad_transformacion');
     $transformacion['cantidad'] = Request::input('cantidad');

     if(!empty($transformacion['descripcion']) && !empty($transformacion['tipo']) && !empty($transformacion['capacidad']) && !empty($transformacion['unidad'] ) && !empty($transformacion['cantidad'])){
       Transformacion::create($transformacion);
       $trans = Transformacion::all();
       $lastId_trans = $trans->last()->id;
       $input['transformacion_id'] = $lastId_trans;
     }
     /* -------------------------proceso distribuscion------------------------------*/
     $distribucion['descripcion'] = Request::input('descripcion_dis');
     $distribucion['tipo'] = Request::input('tipo_dis');
     $distribucion['capacidad'] = Request::input('capacidad_dis');
     $distribucion['unidad'] = Request::input('unidad_distribucion');
     $distribucion['cantidad'] = Request::input('cantidad_dis');

     if(!empty($transformacion['descripcion']) && !empty($distribucion['tipo']) && !empty($distribucion['capacidad']) && !empty($distribucion['unidad'] ) && !empty($distribucion['cantidad'])){
       Distribucion::create($distribucion);
       $distri = Distribucion::all();
       $lastId_distri = $distri->last()->id;
       $input['distribucion_id'] = $lastId_distri;

     }

     /* -------------------------proceso punto de uso final------------------------------*/
     $pu['descripcion'] = Request::input('descripcion_pu');
     $pu['tipo'] = Request::input('tipo_pu');
     $pu['capacidad'] = Request::input('capacidad_pu');
     $pu['unidad'] = Request::input('unidad_pu_final');
     $pu['cantidad'] = Request::input('cantidad_pu');

     if(!empty($pu['descripcion']) && !empty($pu['tipo']) && !empty($pu['capacidad']) && !empty($pu['unidad'] ) && !empty($pu['cantidad'])){
       Pu_final::create($pu);
       $puf = Pu_final::all();
       $lastId_pufinal = $puf->last()->id;
       $input['pu_final_id'] = $lastId_pufinal;
     }

     /* -------------------------proceso punto de uso final------------------------------*/
     $input['codigo_proyecto'] = Request::input('codigo');
     $input['nombre_proyecto'] = Request::input('nombre');
     $input['fecha_contrato'] = Request::input('fecha');
     $input['cliente_id'] = Request::input('cliente_id');
     $input['propietario'] = Request::input('propietario');
     $input['departamento'] = Request::input('departamento');
     $input['municipio'] = Request::input('municipio');
     $input['tipo_zona'] = Request::input('zona');
     $input['valor_contrato_inicial'] = Request::input('contrato_inicial');
     $input['otrosi_id'] = $lastId_otrosi;
     $input['valor_contrato_final'] = Request::input('contrato_final');
     $input['plan_pago'] = Request::input('plan_pago');
     $input['resumen'] = Request::input('resumen');


     $codigorepe = Administrativa::where('codigo_proyecto',Request::input('codigo'))->get();
     if ($codigorepe->count() == 1) {
       Session::flash('message', 'el codigo ya esta registrado!');
       Session::flash('class', 'danger');
       return redirect()->route('administrativas.create');
     }
     else {
       Administrativa::create($input);
       Session::flash('message', 'Contrato creado correctamente!');
       Session::flash('class', 'success');
       return redirect()->route('administrativas.index');
     }


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
       $administrativas = Administrativa::findOrFail($id);

       $clientes=Cliente::all();
       $otrosis=Otrosi::all();
       $distribuciones=Distribucion::all();
       $transformaciones=Transformacion::all();
       $pu_finales=Pu_final::all();

       return view('administrativas.edit',compact('administrativas','clientes','otrosis','distribuciones','transformaciones','pu_finales'));

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
       $administrativas = Administrativa::findOrFail($id);
       $input = Request::all();

       $codigorepe = Administrativa::where('codigo_proyecto',Request::input('codigo'))->get();
       if ($codigorepe->count() == 1) {
         Session::flash('message', 'el codigo ya esta registrado no se puede modificar!');
         Session::flash('class', 'danger');
         return redirect()->route('administrativas.index');
       }
       else {
         $administrativas->update($input);
         Session::flash('message', 'Contrato editado!');
         Session::flash('class', 'success');
         return redirect()->route('administrativas.index');
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
      $otrosis = Otrosi::findOrFail($id);
      $otrosis->delete();

      $transformacion = Transformacion::findOrFail($id);
      $transformacion->delete();

      $distribucion = Distribucion::findOrFail($id);
      $distribucion->delete();

      $pu_final = Pu_final::findOrFail($id);
      $pu_final->delete();

      $administrativas = Administrativa::findOrFail($id);
      $administrativas->delete();
       Session::flash('message', 'Proyecto eliminado eliminado');
       Session::flash('class', 'danger');
       return redirect('administrativas');
   }

}
