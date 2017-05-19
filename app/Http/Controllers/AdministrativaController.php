<?php

namespace App\Http\Controllers;
use App\Administrativa;
use App\Cliente;
use App\Juridica;
use App\Otrosi;
use App\Distribucion;
use App\Departamento;
use App\Municipio;
use App\Transformacion;
use App\Pu_final;
use App\Consignacion;
use App\Cuenta_cobro;
use App\Factura;
use App\Valor_adicional;
use App\Observacion;
use Illuminate\Http\Request;
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
    public function viewpdf()
    {
      $pdf = PDF::loadView('administrativas.show');
      return $pdf->download('archivo.pdf');

    }
    //  metodo que permite retornar una vista con todos los datos de los registros
    public function index()
    {
      $administrativas = Administrativa::all();
      $clientes = Cliente::all();
      $otrosis = Otrosi::all();
      $distribuciones = Distribucion::all();
      $transformaciones = Transformacion::all();
      $pu_finales = Pu_final::all();
      return view('administrativas.index',compact('administrativas','otrosis'));        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  metodo que permite capturar todos los datos de los modelos relacionados para mostrar datos en la vista a manera de "selects"
     public function create()
     {
       $clientes=Cliente::all();
       $juridicas = Juridica::all();
       $otrosis=Otrosi::all();
       $distribuciones=Distribucion::all();
       $transformaciones=Transformacion::all();
       $pu_finales=Pu_final::all();
       $departamentos = Departamento::all();
       return view('administrativas.create',compact('clientes','otrosis','distribuciones','transformaciones','pu_finales','departamentos','juridicas'));
     }

    //  metodo que permite capturar el Request mediante una ruta ajax para llenar un select dinamico dependiente
     public function getMuni(Request $request){

       $data = Municipio::select('nombre','id')->where('departamento_id',$request->id)->get();
       return response()->json($data);
     }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    // metodo que rescata todos los datos en los inputs del formulario para asignarlos arreglos y con el metodo create acceder al modelo y crear un registro
    public function store(Request $request)
    {
       $input = $request->all();
       //  ********************************************************************************
       //  ********************************************************************************
      //  almacenar en un arreglo $administrativa los datos provenientes desde el formulario de datos basicos
       $administrativa['codigo_proyecto'] = $request->codigo;
       $administrativa['nombre_proyecto'] = $request->nombre;
       $administrativa['fecha_contrato'] = $request->fecha;
       $administrativa['cliente_id'] = $request->cliente_id;
       $administrativa['juridica_id'] = $request->juridica_id;
       $administrativa['departamento_id'] = $request->departamento;
       $administrativa['municipio'] = $request->municipio;
       $administrativa['tipo_zona'] = $request->zona;
       $administrativa['valor_contrato_inicial'] = str_replace(',','',$request->contrato_inicial);
       $administrativa['valor_iva'] = str_replace('.','',$request->iva);
       $administrativa['valor_contrato_final'] =str_replace('.','',$request->contrato_final);
       $administrativa['plan_pago'] = $request->plan_pago;
       $administrativa['saldo'] =  $administrativa['valor_contrato_final'];
       $administrativa['valor_total_contrato'] =  $administrativa['valor_contrato_final'];



       $codigorepe = Administrativa::where('codigo_proyecto',$request->codigo)->get();
       //  condicional
       if ($codigorepe->count() == 1) {
         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'el codigo ya esta registrado no se puede crear!');
         Session::flash('class', 'danger');

        //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }
       else{
         //  funsion que permite actualizar los datos de un registro almacenado en la variable $input
         Administrativa::create($administrativa);
         $admins = Administrativa::all();
         $lastId_admin = $admins->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

         $registro = Administrativa::findOrFail($lastId_admin);
         $registro->saldo = $registro->valor_contrato_final - $registro->pagado;

         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'Contrato creado!');
         Session::flash('class', 'success');
       }

      //  funcion para traer todos los registros de administrativa
       $admin = Administrativa::all();

      //  funcion para traer el ultimo registro de administrativa
       $lastId_admin = $admin->last()->id;

       $obs['observacion'] = $request->observacion;
       $obs['administrativa_id'] = $lastId_admin;


       Observacion::create($obs);
      //  codigo para insertar los otrosi que vienen desde un arreglo y recorrerlo para hacer el create



        // for ($f=0; $f<count($input['adicional']['detalle']); $f++) {
        //
        //     if (!empty($input['adicional']['valor'][$f]) && !empty($input['adicional']['detalle'][$f])){
        //
        //           $datos4['valor'] = $input['adicional']['valor'][$f];
        //           $datos4['detalle'] = $input['adicional']['detalle'][$f];
        //           $datos4['administrativa_id'] = $lastId_admin;
        //
        //           Valor_adicional::create($datos4);
        //     }
        // }
        for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

              if (!empty($input['transformacion']['descripcion'][$a]) &&
                  !empty($input['transformacion']['tipo'][$a]) &&
                  !empty($input['transformacion']['capacidad'][$a]) &&
                  !empty($input['transformacion']['unidad_transformacion'][$a]) &&
                  !empty($input['transformacion']['cantidad'][$a])) {

                    $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
                    $datos1['tipo'] = $input['transformacion']['tipo'][$a];
                    $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
                    $datos1['unidad'] = $input['transformacion']['unidad_transformacion'][$a];
                    $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
                    $datos1['administrativa_id'] = $lastId_admin;

                    Transformacion::create($datos1);
              }
        }

        for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {
            if (!empty($input['distribucion']['descripcion_dis'][$x]) &&
                !empty($input['distribucion']['tipo_dis'][$x]) &&
                !empty($input['distribucion']['unidad_distribucion'][$x]) &&
                !empty($input['distribucion']['cantidad_dis'][$x])){

                  $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                  $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                  $datos2['unidad'] = $input['distribucion']['unidad_distribucion'][$x];
                  $datos2['cantidad'] = $input['distribucion']['cantidad_dis'][$x];
                  $datos2['administrativa_id'] = $lastId_admin;

                  Distribucion::create($datos2);
            }
        }

        for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {
            if (!empty($input['pu_final']['descripcion_pu'][$i]) &&
                !empty($input['pu_final']['tipo_pu'][$i]) &&
                !empty($input['pu_final']['unidad_pu_final'][$i]) &&
                !empty($input['pu_final']['cantidad_pu'][$i])) {

                  $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
                  $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
                  $datos3['unidad'] = $input['pu_final']['unidad_pu_final'][$i];
                  $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
                  $datos3['administrativa_id'] = $lastId_admin;

                  Pu_final::create($datos3);
            }
        }
        // dd($datos4);
        return redirect()->route('administrativas.index');

   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    // metodo que permite hacer una busqueda de acuerdo a un id en la base de dato retornando un registro
   public function show($id)
   {
      //  funcion que permite acceder al modelo y este a su ves ir a la base de datos y encontrar un registro
       $administrativa = Administrativa::find($id);

       $muni_Id = Municipio::select('id')->where('id',$administrativa->municipio)->get();
       $municipio = Municipio::find($muni_Id);

       $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
       $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
       $observaciones = Observacion::where('observacion.administrativa_id', '=', $id)->get();
      //  dd($observaciones);
      //  die();
       $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
       $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
       $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
       $consignaciones = Consignacion::where('consignacion.administrativa_id', '=', $id)->get();
       $cuenta_cobros = Cuenta_cobro::where('cuenta_cobro.administrativa_id', '=', $id)->get();
       $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();
       $juridicas = Juridica::select('razon_social')->where('id',$administrativa->juridica_id)->get();

      //  dd($transformaciones);
      //  die();
      //  funcion que permite retornar una vista con los datos ya buscados
       return view('administrativas.show',compact('administrativa','municipio','otrosis','transformaciones','distribuciones','pu_finales','consignaciones','cuenta_cobros','facturas','adicionales','juridicas','observaciones'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    // metodo que permite seleccionar un registro con todos sus datos correspondientes y enviarlos a otra vista para ser editados
   public function edit($id)
   {
      //  funcion que con el codigo capturado busca en la base de datos el registro a editar
      $administrativas = Administrativa::find($id);

      // $admin  = $administrativas->id;
      $departamentos = Departamento::all();
      $clientes =Cliente::all();
      $juridicas = Juridica::all();

      $muni_Id = Municipio::select('id')->where('id',$administrativas->municipio)->get();
      $municipio = Municipio::find($muni_Id);

      $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
      $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
      $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
      $consignaciones = Consignacion::where('consignacion.administrativa_id', '=', $id)->get();
      $cuenta_cobros = Cuenta_cobro::where('cuenta_cobro.administrativa_id', '=', $id)->get();
      $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();
      $observaciones = Observacion::where('observacion.administrativa_id', '=', $id)->get();


      //  funcion que retorna una vista con todos los datos del registro ya buscado
       return view('administrativas.edit',compact('administrativas','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipio','adicionales','facturas','cuenta_cobros','consignaciones','observaciones'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    // metodo que permite capturar los datos editados en la vista edit mandando un id que permita sabar a la base de datos cual registro editar
   public function update(Request $request, $id)
   {
       $input = $request->all();
       $depart = $request->departamento;

       $administrativas = Administrativa::findOrFail($id);




       //  condicional que permite saber si el codigo de proyecto que se envio es igual a uno ya exitente cumpla con la condicion de no permitir actualizar el codigo por uno ya existent
       $codigorepe = Administrativa::where('codigo_proyecto',$request->codigo)->get();
       //  condicional
       if ($codigorepe->count() == 1) {
         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'el codigo ya esta registrado no se puede modificar!');
         Session::flash('class', 'danger');

        //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }
       else {
         //  funsion que permite actualizar los datos de un registro almacenado en la variable $input

         $administrativas->update($input);

         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'Contrato editado!');
         Session::flash('class', 'success');

         //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    // metodo que permite eliminar un registro de acuerdo a su id
   public function destroy($id)
   {

     $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
     foreach ($otrosis as $key => $otro) {

      $otro->delete();

     }

     $transformacion = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
     foreach ($transformacion as $key => $transfo) {

       $transfo->delete();

     }

     $distribucion = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
     foreach ($distribucion as $key => $distri) {

       $distri->delete();
     }

     $pu_final = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
     foreach ($pu_final as $key => $pu) {

       $pu_final->delete();

     }

     $adicional = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
     foreach ($adicional as $key => $adic) {

       $adic->delete();

     }
      //  //  funcion que permite encontrar o identificar un registro y almacenarlas en una variable
      $administrativa = Administrativa::findOrFail($id);
      // $administrativas = Administrativa::select('id')->where('administrativa.id',$id)->get();
      $administrativa->delete();
      // dd($id);
      // die();
       //  redireccionamiento a una vista
       Session::flash('message', 'Proyecto eliminado eliminado');
       Session::flash('class', 'danger');
       return redirect('administrativas');


   }

}
