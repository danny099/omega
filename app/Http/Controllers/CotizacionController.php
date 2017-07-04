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
use DB;

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
         $datos = Cotizacion::count('codigo');
         $num = Cotizacion::max('codigo');
        //  dd($datos);
        //  die();
        //  $num = "COT-2017-A-999";
         $numero = explode("-", $num);
         $flag = true;

         if ($datos == 0) {

           $codigo = "COT-2017-A-001";

         }elseif ($numero[3] >= 1) {

           $i = $numero[2];

           while ($flag) {



             if ($numero[3] < 9) {
               $numero[3] = $numero[3] +1;
               $codigo = $numero[0]."-".$numero[1]."-".$i."-00".$numero[3];
               $flag = false;


             }elseif ($numero[3] <= 98) {
               $numero[3] = $numero[3] +1;
               $codigo = $numero[0]."-".$numero[1]."-".$i."-0".$numero[3];


               $flag = false;

             }elseif ($numero[3] < 999) {
               $numero[3] = $numero[3] +1;
               $codigo = $numero[0]."-".$numero[1]."-".$i."-".$numero[3];

               $flag = false;
             }elseif($numero[3]>=999){
               $numero[3]=0;
               $i++;

             }


           }
         }

//Salida: viernes 24 de febrero del 2012
         return view('cotizaciones.create',compact('clientes','juridicas','departamentos','codigo'));
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

         $now = new \DateTime();
         $fecha = $now->format('Y-m-d');


         $cotizacion['dirigido'] = $request->dirigido;
         $cotizacion['codigo'] = $request->codigo;
         $cotizacion['cliente_id'] = $request->cliente_id;
         $cotizacion['juridica_id'] = $request->juridica_id;
         $cotizacion['fecha'] = $fecha;
         $cotizacion['nombre'] = $request->nombre;
         $cotizacion['municipio'] = $request->municipio;
         $cotizacion['departamento_id'] = $request->departamento;
         $cotizacion['formas_pago'] = $request->formas_pago;
         $cotizacion['tiempo'] = $request->tiempo;
         $cotizacion['entrega'] = $request->entrega;
         $cotizacion['visitas'] = $request->visitas;
         $cotizacion['validez'] = $request->validez;
         $cotizacion['subtotal'] = str_replace(',','',$request->subtotal);
         $cotizacion['iva'] = str_replace(',','',$request->iva);
         $cotizacion['total'] = str_replace(',','',$request->total);
         $cotizacion['adicional'] = $request->adici;
         $cotizacion['observaciones'] = $request->observacion;
         $tension = $request->valor;

         Cotizacion::create($cotizacion);
         $cotiza = Cotizacion::all();
         $lastId_cotiza = $cotiza->last()->id;

         $registro = Cotizacion::findOrFail($lastId_cotiza);




         for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

               if (!is_null($input['transformacion']['descripcion'][$a]) &&
                   !is_null($input['transformacion']['tipo'][$a]) &&
                   !is_null($input['transformacion']['capacidad'][$a]) &&
                   !is_null($input['transformacion']['cantidad'][$a]) &&
                   !is_null($input['transformacion']['tipo_refrigeracion'][$a])) {

                     $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
                     $datos1['tipo'] = $input['transformacion']['tipo'][$a];
                     $datos1['nivel_tension'] = $tension;
                     $datos1['unidad'] = 'Und';
                     $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
                     $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
                     $datos1['tipo_refrigeracion'] = $input['transformacion']['tipo_refrigeracion'][$a];
                     $datos1['cotizacion_id'] = $lastId_cotiza;

                     $texto['detalles'] = $datos1['descripcion'].' '.$datos1['tipo'].' '. $datos1['cantidad'].' '.$datos1['capacidad'];
                     $texto['cantidad'] = $datos1['cantidad'];
                     $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni'][$a]);
                     $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi'][$a]);
                     $texto['cotizacion_id'] = $lastId_cotiza;

                     Valorcot::create($texto);

                     Transformacion::create($datos1);


               }
         }

         for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {

             if (!is_null($input['distribucion']['descripcion_dis'][$x]) &&
                 !is_null($input['distribucion']['tipo_dis'][$x]) &&
                 !is_null($input['distribucion']['nivel_tension_dis'][$x]) &&
                 !is_null($input['distribucion']['cantidad_dis'][$x]) &&
                 !is_null($input['distribucion']['apoyos_dis'][$x])  &&
                 !is_null($input['distribucion']['cajas_dis'][$x])){

                   $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
                   $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
                   $datos2['nivel_tension'] = $input['distribucion']['nivel_tension_dis'][$x];
                   $datos2['unidad'] = 'km';
                   $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);

                   if ($datos2['tipo'] == 'Aérea' && $input['distribucion']['apoyos_dis'][$x] == 0) {

                     $datos2['apoyos'] = 'Según Plano';

                   }else {
                     $datos2['apoyos'] = $input['distribucion']['apoyos_dis'][$x];
                   }


                   if ($datos2['tipo'] == 'Subterránea' && $input['distribucion']['cajas_dis'][$x] == 0) {

                     $datos2['cajas'] = 'Según Plano';

                   }else {
                     $datos2['cajas'] = $input['distribucion']['cajas_dis'][$x];
                   }

                   $datos2['notas'] = $input['distribucion']['notas_dis'][$x];
                   $datos2['cotizacion_id'] = $lastId_cotiza;

                   $texto['detalles'] = $datos2['descripcion'].' '.$datos2['tipo'].' '. $datos2['cantidad'];
                   $texto['cantidad'] = $datos2['cantidad'];
                   $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni_dis'][$x]);
                   $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi_dis'][$x]);
                   $texto['cotizacion_id'] = $lastId_cotiza;

                   Valorcot::create($texto);
                   Distribucion::create($datos2);
             }
         }

         for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {
             if (!is_null($input['pu_final']['descripcion_pu'][$i]) &&
                 !is_null($input['pu_final']['tipo_pu'][$i]) &&
                 !is_null($input['pu_final']['estrato_pu'][$i]) &&
                 !is_null($input['pu_final']['cantidad_pu'][$i]) &&
                 !is_null($input['pu_final']['metros_pu'][$i]) &&
                 !is_null($input['pu_final']['kva_pu'][$i])) {

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

                   if ($datos3['tipo'] == 'Casa') {

                     $datos3['acometidas'] = $datos3['cantidad'];

                   }

                   if ($datos3['tipo'] == 'Local comercial') {

                     $datos3['acometidas'] = $datos3['cantidad'];

                   }

                   if ($datos3['tipo'] == 'Zona común') {

                     $datos3['acometidas'] = $datos3['cantidad'];

                   }

                   if ($datos3['tipo'] == 'Bodega') {

                     $datos3['acometidas'] = $datos3['cantidad'];

                   }

                   if (isset($input['pu_final']['torres'][$i])) {
                     if (!is_null($input['pu_final']['torres'][$i])) {

                       $datos3['acometidas'] = $input['pu_final']['torres'][$i];
                       $datos3['torres'] = $datos3['acometidas'];

                       $datoss['acometidas'] = $input['pu_final']['torres'][$i];
                       $datoss['torres'] = $datoss['acometidas'];

                     }
                   }

                   if ($datos3['tipo'] == 'Apartamentos') {

                     $datos['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
                     $datos['tipo'] = 'Punto Fijo';
                     $datos['estrato'] = $input['pu_final']['estrato_pu'][$i];
                     $datos['unidad'] = 'Und';
                     $datos['cantidad'] = $datoss['torres'];
                     $datos['metros'] = $input['pu_final']['metros_pu'][$i];
                     $datos['acometidas'] = $datoss['acometidas'];
                     $datos['torres'] = $datoss['torres'];
                       //  $datos['metros'] = $input['pu_final']['metros_pu'][$r];
                     $datos['cotizacion_id'] = $lastId_cotiza;

                     $texto1['detalles'] = $datos['descripcion'].' '.$datos['tipo'].' '. $datos['cantidad'];
                     $texto1['cantidad'] = $datos['cantidad'];
                     $texto1['valor_uni'] = str_replace(',','',$input['valores']['valor_uni_pu'][$i+1]);
                     $texto1['valor_total'] = str_replace(',','',$input['valores']['valor_multi_pu'][$i+1]);
                     $texto1['cotizacion_id'] = $lastId_cotiza;



                     Valorcot::create($texto1);

                     Pu_final::create($datos);

                 }


                   $datos3['cotizacion_id'] = $lastId_cotiza;

                   $texto['detalles'] = $datos3['descripcion'].' '.$datos3['tipo'].' '. $datos3['cantidad'];
                   $texto['cantidad'] = $datos3['cantidad'];
                   $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni_pu'][$i]);
                   $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi_pu'][$i]);
                   $texto['cotizacion_id'] = $lastId_cotiza;
                  //  dd($texto);
                  //  die();
                   Valorcot::create($texto);
                   Pu_final::create($datos3);

             }
         }
         Session::flash('message', 'Cotización Creada!!');
         Session::flash('class', 'success');
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
      $cotizaciones = Cotizacion::findOrFail($id);
      $clientes = Cliente::all();
      $juridicas = Juridica::all();
      $departamentos = Departamento::all();
      $muni_Id = Municipio::select('id')->where('id',$cotizaciones->municipio)->get();
      $municipio = Municipio::find($muni_Id);
      $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $id)->get();
      // $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $id)->get();
      // $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $id)->get();
      $valorcot = Valorcot::where('valorcot.cotizacion_id', '=', $id)->get();

      $datos1 = DB::table('valorcot')->where('cotizacion_id', '=', $id)->where('detalles', 'like', '%transformacion%')->get();
      $datos2 = DB::table('valorcot')->where('cotizacion_id', '=', $id)->where('detalles', 'like', '%distribucion%')->get();
      $datos3 = DB::table('valorcot')->where('cotizacion_id', '=', $id)->where('detalles', 'like', '%final%')->get();
      $mts = DB::table('distribucion')->where('cotizacion_id', '=', $id)->where('descripcion', 'like', '%MT%')->get();
      $bts = DB::table('distribucion')->where('cotizacion_id', '=', $id)->where('descripcion', 'like', '%BT%')->get();
      $pu_finales = DB::table('pu_final')->where('cotizacion_id', '=', $id)->where('tipo', '!=', 'Punto Fijo')->get();
      // dd($pu_finales);
      // die();


      return view('cotizaciones.edit',compact('cotizaciones','departamentos','clientes','juridicas','transformaciones','mts','bts','pu_finales','municipio','valorcot','datos1','datos2','datos3'));
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
        // dd($input);
        // die();
        $cotiza = Cotizacion::findOrFail($id);

        $cotizacion['dirigido'] = $request->dirigido;
        $cotizacion['codigo'] = $request->codigo;
        // $cotizacion['cliente_id'] = $request->cliente_id;
        // $cotizacion['juridica_id'] = $request->juridica_id;
        $cotizacion['nombre'] = $request->nombre;
        $cotizacion['municipio'] = $request->municipio;
        $cotizacion['departamento_id'] = $request->departamento_id;
        $cotizacion['formas_pago'] = $request->formas_pago;
        $cotizacion['tiempo'] = $request->tiempo;
        $cotizacion['entrega'] = $request->entrega;
        $cotizacion['validez'] = $request->validez;
        $cotizacion['subtotal'] = str_replace(',','',$request->subtotal);
        $cotizacion['iva'] = str_replace(',','',$request->iva);
        $cotizacion['total'] = str_replace(',','',$request->total);
        $cotizacion['adicional'] = $request->adici;
        $cotizacion['observaciones'] = $request->observacion;
        $tension = $request->valor;

        if ($request->tipo_regimen == 1) {

          $cotizacion['cliente_id'] = $request->cliente_id;
          $cotizacion['juridica_id'] = null;
          // $cotiza->juridica_id = null;
          // $cotiza->save();

        }else {

          $cotizacion['juridica_id'] = $request->juridica_id;
          $cotizacion['cliente_id']= null;
          // $cotiza->save();

        }

        if ($request->transformacion == 'transformacion') {

        }else {
          for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){

            $id1 = $input['transformacion']['id'][$a];
            $transfor = Transformacion::findOrFail($id1);
            $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
            $datos1['tipo'] = $input['transformacion']['tipo'][$a];
            $datos1['nivel_tension'] = $tension;
            $datos1['unidad'] = 'Und';
            $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
            $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
            $datos1['tipo_refrigeracion'] = $input['transformacion']['tipo_refrigeracion'][$a];

            $id2 = $input['valores']['id'][$a];
            $valor = Valorcot::findOrFail($id2);
            $texto['detalles'] = $datos1['descripcion'].' '.$datos1['tipo'].' '. $datos1['cantidad'].' '.$datos1['capacidad'];
            $texto['cantidad'] = $datos1['cantidad'];
            $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni'][$a]);
            $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi'][$a]);
            // $texto['cotizacion_id'] = $lastId_cotiza;
            //
            // Valorcot::create($texto);

            $valor->update($texto);

            $transfor->update($datos1);

          }
        }


        if ($request->distribucion == 'distribucion') {

        }else {
          for ($x = 0; $x < count($input['distribucion']['descripcion_dis']); $x++) {

            $id1 = $input['distribucion']['id'][$x];
            $distri = Distribucion::findOrFail($id1);
            $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
            $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
            $datos2['nivel_tension'] = $input['distribucion']['nivel_tension_dis'][$x];
            $datos2['unidad'] = 'km';
            $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);

            if ($datos2['tipo'] == 'Aérea' && $input['distribucion']['apoyos_dis'][$x] == 0) {

              $datos2['apoyos'] = 'Según Plano';

            }else {
              $datos2['apoyos'] = $input['distribucion']['apoyos_dis'][$x];
            }


            if ($datos2['tipo'] == 'Subterránea' && $input['distribucion']['cajas_dis'][$x] == 0) {

              $datos2['cajas'] = 'Según Plano';

            }else {
              $datos2['cajas'] = $input['distribucion']['cajas_dis'][$x];
            }

            $datos2['notas'] = $input['distribucion']['notas_dis'][$x];

            $id2 = $input['valores']['id_dis'][$x];
            $valor = Valorcot::findOrFail($id2);
            $texto['detalles'] = $datos2['descripcion'].' '.$datos2['tipo'].' '. $datos2['cantidad'];
            $texto['cantidad'] = $datos2['cantidad'];
            $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni_dis'][$x]);
            $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi_dis'][$x]);
            // $texto['cotizacion_id'] = $lastId_cotiza;

            // Valorcot::create($texto);
            $valor->update($texto);

            $distri->update($datos2);

          }
        }

        if ($request->pu_final == 'pu_final') {
          # code...
        }else {
          for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {

            $id1 = $input['pu']['id'][$i];
            $pu = Pu_final::findOrFail($id1);
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

            if ($datos3['tipo'] == 'Casa') {

              $datos3['acometidas'] = $datos3['cantidad'];

            }

            if ($datos3['tipo'] == 'Local comercial') {

              $datos3['acometidas'] = $datos3['cantidad'];

            }

            if ($datos3['tipo'] == 'Zona común') {

              $datos3['acometidas'] = $datos3['cantidad'];

            }

            if ($datos3['tipo'] == 'Bodega') {

              $datos3['acometidas'] = $datos3['cantidad'];

            }

            if (isset($input['pu_final']['torres'][$i])) {
              if (!is_null($input['pu_final']['torres'][$i])) {

                $datos3['acometidas'] = $input['pu_final']['torres'][$i];
                $datos3['torres'] = $datos3['acometidas'];

                $datoss['acometidas'] = $input['pu_final']['torres'][$i];
                $datoss['torres'] = $datoss['acometidas'];


              }
            }

            if ($datos3['tipo'] == 'Apartamentos') {

              $datos['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
              $datos['tipo'] = 'Punto Fijo';
              $datos['estrato'] = $input['pu_final']['estrato_pu'][$i];
              $datos['unidad'] = 'Und';
              $datos['cantidad'] = $datoss['torres'];
              $datos['metros'] = $input['pu_final']['metros_pu'][$i];
              $datos['acometidas'] = $datoss['acometidas'];
              $datos['torres'] = $datoss['torres'];
                //  $datos['metros'] = $input['pu_final']['metros_pu'][$r];
              // $datos['cotizacion_id'] = $lastId_cotiza;
              // Pu_final::create($datos);

          }

            $id2 = $input['valores']['id_pu'][$i];
            $valor = Valorcot::findOrFail($id2);
            $texto['detalles'] = $datos3['descripcion'].' '.$datos3['tipo'].' '. $datos3['cantidad'];
            $texto['cantidad'] = $datos3['cantidad'];
            $texto['valor_uni'] = str_replace(',','',$input['valores']['valor_uni_pu'][$i]);
            $texto['valor_total'] = str_replace(',','',$input['valores']['valor_multi_pu'][$i]);
            // $texto['cotizacion_id'] = $lastId_cotiza;
            //
            // Valorcot::create($texto);
            $valor->update($texto);
            $pu->update($datos3);

          }
        }

        $cotiza->update($cotizacion);
        Session::flash('message', 'Cotización editada!!');
        Session::flash('class', 'success');
        return redirect()->route('cotizaciones.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $cotizacion =Cotizacion::findOrFail($id);

      $transfor = Transformacion::where('transformacion.cotizacion_id', '=', $id)->get();
      foreach ($transfor as $key => $trans) {

        $registro = Transformacion::findOrFail($trans->id);

        if ($registro->administrativa_id == null) {
          $registro->delete();
        }else {
          $registro->cotizacion_id = null;
          $registro->save();
        }

      }

      $distribucion = Distribucion::where('distribucion.cotizacion_id', '=', $id)->get();
      foreach ($distribucion as $key => $distri) {

        $registro = Distribucion::findOrFail($distri->id);

        if ($registro->administrativa_id == null) {
          $registro->delete();
        }else {
          $registro->cotizacion_id = null;
          $registro->save();
        }



      }

      $pu_final = Pu_final::where('pu_final.cotizacion_id', '=', $id)->get();
      foreach ($pu_final as $key => $pu) {

        $registro = Pu_final::findOrFail($pu->id);

        if ($registro->administrativa_id == null) {
          $registro->delete();
        }else {
          $registro->cotizacion_id = null;
          $registro->save();
        }



      }

      $cotizacion->delete();

      Session::flash('message', 'Cotización eliminado');
      Session::flash('class', 'danger');
      return redirect('cotizaciones');Cotizacion::findOrFail($id);


    }
}
