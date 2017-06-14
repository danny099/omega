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
use App\Cotizacion;
use App\Valorcot;
use App\Valor_adicional;
use App\Observacion;
use Illuminate\Http\Request;
use Session;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $cotizaciones = Cotizacion::all();
         return view('cotizaciones.index',compact('cotizaciones'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         $clientes = Cliente::all();
         $juridicas = Juridica::all();
         $departamentos = Departamento::all();
         $cantidad = Cotizacion::count('codigo');
         $flag = true;
         $contador = 64;

        //  while ($flag) {
         //
        //    $contador++;
         //
        //    if ($cantidad == 0) {
        //      $codigo =  "A-001";
        //      $flag = false;
        //    }
         //
        //    if ($cantidad < 10) {
         //
        //      $codigo = chr($contador)."00".$cantidad+1;
         //
        //    }elseif ($cantidad < 99) {
        //
        //    }
        //  }


      //  for ($i=65; $i <90 ; $i++) { // esto busca los caracteres especiales para poder encontrar las letras del abecedario
      //    $letra = "a";
      //    echo chr($i);
      //   //  echo $letra;
      //  }
      //  die();

        //  $cantidad = Cotizacion::count();
        //  if ($cantidad == 0) {
        //    $codigo = "A-002";
        //  }else {
        //    $cod = Cotizacion::max('codigo');
         //
        //  }
         //
        //  dd($cod);
        //  die();
         return view('cotizaciones.create',compact('clientes','juridicas','departamentos'));
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

         $cotizacion['dirigido'] = $request->dirigido;
         $cotizacion['codigo'] = '0001';
         $cotizacion['cliente_id'] = $request->cliente_id;
         $cotizacion['juridica_id'] = $request->juridica_id;
         $cotizacion['nombre'] = $request->nombre;
         $cotizacion['municipio'] = $request->municipio;
         $cotizacion['departamento_id'] = $request->departamento;
         $cotizacion['subtotal'] = $request->subtotal;
         $cotizacion['iva'] = $request->iva;
         $cotizacion['total'] = $request->total;
         $cotizacion['observaciones'] = $request->observacion;

         Cotizacion::create($cotizacion);
         $cotiza = Cotizacion::all();
         $lastId_cotiza = $cotiza->last()->id;

         $registro = Cotizacion::findOrFail($lastId_cotiza);




         for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

               if (!empty($input['transformacion']['descripcion'][$a]) &&
                   !empty($input['transformacion']['tipo'][$a]) &&
                   !empty($input['transformacion']['nivel_tension'][$a]) &&
                   !empty($input['transformacion']['capacidad'][$a]) &&
                   !empty($input['transformacion']['cantidad'][$a]) &&
                   !empty($input['transformacion']['tipo_refrigeracion'][$a])) {

                     $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
                     $datos1['tipo'] = $input['transformacion']['tipo'][$a];
                     $datos1['nivel_tension'] = $input['transformacion']['nivel_tension'][$a];
                     $datos1['unidad'] = 'Und';
                     $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
                     $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
                     $datos1['tipo_refrigeracion'] = $input['transformacion']['tipo_refrigeracion'][$a];
                     $datos1['cotizacion_id'] = $lastId_cotiza;

                     $texto['detalles'] = $datos1['descripcion'].' '.$datos1['tipo'].' '. $datos1['cantidad'].' '.$datos1['capacidad'];
                     $texto['cantidad'] = $datos1['cantidad'];
                     $texto['valor_uni'] = $input['valores']['valor_uni'][$a];
                     $texto['valor_total'] = $input['valores']['valor_multi'][$a];
                     $texto['cotizacion_id'] = $lastId_cotiza;

                     Valorcot::create($texto);
                     Transformacion::create($datos1);

               }
         }

         for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {
             if (!empty($input['distribucion']['descripcion_dis'][$x]) &&
                 !empty($input['distribucion']['tipo_dis'][$x]) &&
                 !empty($input['distribucion']['nivel_tension_dis'][$x]) &&
                 !empty($input['distribucion']['cantidad_dis'][$x]) &&
                 !empty($input['distribucion']['apoyos_dis'][$x])  &&
                 !empty($input['distribucion']['cajas_dis'][$x])  &&
                 !empty($input['distribucion']['notas_dis'][$x])){

                   $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                   $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                   $datos['nivel_tension'] = $input['distribucion']['nivel_tension_dis'][$x];
                   $datos2['unidad'] = 'km';
                   $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);
                   $datos2['apoyos'] = $input['distribucion']['apoyos_dis'][$x];
                   $datos2['cajas'] = $input['distribucion']['cajas_dis'][$x];
                   $datos2['notas'] = $input['distribucion']['notas_dis'][$x];
                   $datos2['cotizacion_id'] = $lastId_cotiza;

                   $texto['detalles'] = $datos2['descripcion'].' '.$datos2['tipo'].' '. $datos2['cantidad'];
                   $texto['cantidad'] = $datos2['cantidad'];
                   $texto['valor_uni'] = $input['valores']['valor_uni'][$x];
                   $texto['valor_total'] = $input['valores']['valor_multi'][$x];
                   $texto['cotizacion_id'] = $lastId_cotiza;

                   Valorcot::create($texto);
                   Distribucion::create($datos2);
             }
         }

         for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {
             if (!empty($input['pu_final']['descripcion_pu'][$i]) &&
                 !empty($input['pu_final']['tipo_pu'][$i]) &&
                 !empty($input['pu_final']['estrato_pu'][$i]) &&
                 !empty($input['pu_final']['cantidad_pu'][$i]) &&
                 !empty($input['pu_final']['metros_pu'][$i]) &&
                 !empty($input['pu_final']['kva_pu'][$i])  &&
                 !empty($input['pu_final']['acomedidas_pu'][$i])) {

                   $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
                   $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
                   $datos3['estrato'] = $input['pu_final']['estrato_pu'][$i];
                   $datos3['unidad'] = 'Und';
                   $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
                   $datos3['metros'] = $input['pu_final']['metros_pu'][$i];
                   $datos3['kva'] = $input['pu_final']['kva_pu'][$i];
                   $datos3['acometidas'] = $input['pu_final']['acomedidas_pu'][$i];
                   $datos3['cotizacion_id'] = $lastId_cotiza;

                   $texto['detalles'] = $datos3['descripcion'].' '.$datos3['tipo'].' '. $datos3['cantidad'];
                   $texto['cantidad'] = $datos3['cantidad'];
                   $texto['valor_uni'] = $input['valores']['valor_uni'][$i];
                   $texto['valor_total'] = $input['valores']['valor_multi'][$i];
                   $texto['cotizacion_id'] = $lastId_cotiza;

                   Valorcot::create($texto);

                   Pu_final::create($datos3);

             }
         }

         return redirect()->route('cotizaciones.index');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cotizacion = Cotizacion::find($id);

      $muni_Id = Municipio::select('id')->where('id',$cotizacion->municipio)->get();
      $municipio = Municipio::find($muni_Id);

      $observaciones = Observacion::where('observacion.cotizacion_id', '=', $id)->get();
      $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $id)->get();
      $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $id)->get();
      $juridicas = Juridica::select('razon_social')->where('id',$cotizacion->juridica_id)->get();

      return view('administrativas.show',compact('cotizacion','municipio','transformaciones','distribuciones','pu_finales','juridicas','observaciones'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
