<?php

namespace App\Http\Controllers;
use App\Administrativa;
use App\Cliente;
use App\Otrosi;
use App\Distribucion;
use App\Departamento;
use App\Municipio;
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
      $administrativas = Administrativa::all();
      $clientes = Cliente::all();
      $otrosis = Otrosi::all();
      $distribuciones = Distribucion::all();
      $transformaciones = Transformacion::all();
      $pu_finales = Pu_final::all();



      return view('administrativas.index',compact('administrativas'));        //
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
       $departamentos = Departamento::all();
       return view('administrativas.create',compact('clientes','otrosis','distribuciones','transformaciones','pu_finales','departamentos'));
   }

//
  public function getMuni(Request $request, $id){
       if($request->ajax()){
           $municipio = Municipio::municipio($id);
           return response()->json($municipio);
       }
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

     foreach ($otrosi->$request->otrosi as $otro)
      {
        Otrosi::create($datos);
      }

     /* -------------------------otrosi------------------------------*/



   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
     $administrativa = Administrativa::find($id);

     return view('administrativas.show',compact('administrativa'));
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


      $administrativas = Administrativa::findOrFail($id);
      $administrativas->delete();
       Session::flash('message', 'Proyecto eliminado eliminado');
       Session::flash('class', 'danger');
       return redirect('administrativas');
       $otrosis = Otrosi::findOrFail($id);
       $otrosis->delete();

       $transformacion = Transformacion::findOrFail($id);
       $transformacion->delete();

       $distribucion = Distribucion::findOrFail($id);
       $distribucion->delete();

       $pu_final = Pu_final::findOrFail($id);
       $pu_final->delete();
   }

}
