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

    //  metodo que permite retornar una vista con todos los datos de los registros
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
       $administrativa['departamento_id'] = $request->departamento;
       $administrativa['municipio'] = $request->municipio;
       $administrativa['tipo_zona'] = $request->zona;
       $administrativa['valor_contrato_inicial'] = $request->contrato_inicial;
       $administrativa['valor_iva'] = $request->iva;
       $administrativa['valor_adicional'] = $request->adicional;
       $administrativa['valor_contrato_final'] = $request->contrato_final;
       $administrativa['plan_pago'] = $request->plan_pago;
       $administrativa['resumen'] = $request->resumen;

      //  funcion para crear el registro en la base datos con los campos traidos del formulario para el area de administrativa
       Administrativa::create($administrativa);
      //  return redirect()->route('administrativas.index');

      //  funcion para traer todos los registros de administrativa
       $admin = Administrativa::all();

      //  funcion para traer el ultimo registro de administrativa
       $lastId_admin = $admin->last()->id;

      //  codigo para insertar los otrosi que vienen desde un arreglo y recorrerlo para hacer el create
       foreach ($request->otrosi as $otro)
        {
          Otrosi::create(['valor'=>$otro,'administrativa_id'=>$lastId_admin]);
        }


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
      //  dd($administrativa);
      //  die();
      //  funcion que permite retornar una vista con los datos ya buscados
       return view('administrativas.show',compact('administrativa','data'));
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
       $administrativas = Administrativa::findOrFail($id);

      //  conjunto de funciones que cargan la informacion anexada y relacionada de otras tablas en la base de datos con el registro correspondiente
       $clientes=Cliente::all();
       $otrosis=Otrosi::all();
       $distribuciones=Distribucion::all();
       $transformaciones=Transformacion::all();
       $pu_finales=Pu_final::all();

      //  funcion que retorna una vista con todos los datos del registro ya buscado
       return view('administrativas.edit',compact('administrativas','clientes','otrosis','distribuciones','transformaciones','pu_finales'));
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
        //  funcion que con el codigo capturado busca en la base de datos el registro a editar
       $administrativas = Administrativa::findOrFail($id);

       //  funcion que permite capturar todos los datos en una variable tipo array
       $input = Request::all();

       //  condicional que permite saber si el codigo de proyecto que se envio es igual a uno ya exitente cumpla con la condicion de no permitir actualizar el codigo por uno ya existent
       $codigorepe = Administrativa::where('codigo_proyecto',Request::input('codigo'))->get();
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
       //  funcion que permite encontrar o identificar un registro y almacenarlas en una variable
       $administrativas = Administrativa::findOrFail($id);
       $otrosis = Otrosi::findOrFail($id);
       $otrosis->delete();

       $transformacion = Transformacion::findOrFail($id);
       $transformacion->delete();

       $distribucion = Distribucion::findOrFail($id);
       $distribucion->delete();

       $pu_final = Pu_final::findOrFail($id);
       $pu_final->delete();
       //  funcion que permite eliminar un registro que se encontro y se almaceno en esa variable
       $administrativas->delete();

       //  redireccionamiento a una vista
       Session::flash('message', 'Proyecto eliminado eliminado');
       Session::flash('class', 'danger');
       return redirect('administrativas');

       //  funciones que hacen lo mismo que la anterior pero se colocan para borrar en cascada los registros relacionados

   }

}
