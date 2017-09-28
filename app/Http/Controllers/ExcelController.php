<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Cliente;
use App\Juridica;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;
use App\Cotizacion;



use DB;
use Excel;

class ExcelController extends Controller
{
  public function importExcel(Request $request)
  {
     $file = Input::file('import_file');

     $result = Excel::selectSheetsByIndex(0)->load($file, function($reader) { $reader->noHeading(); })->get();
     $result = $result->toArray();
     dd($result);
     die();
     $fecha_cot = $result[2][1];
     $dirigido = $result[6][1];
     $representante = $result[7][1];
     $nombre_empresa = $result[8][1];
     $cedula_nit = $result[9][1];
     $direccion = $result[10][1];
     $nombre_proyecto = $result[15][1];
     $direccion_proyecto = $result[16][1];
     $departamento = $result[16][3];
     $municipio = $result[17][1];
     $fecha_terminacion  = $result[18][1];
     $estado_obra = $result[19][1];
     $formas_pago = $result[24][1];
     $tiempo_ejecucion = $result[25][1];
     $valides_oferta = $result[25][3];
     $tiempo_entreda_dictamenes = $result[26][1];
     $visitas = $result[27][1];
     $t_nivle_tension = $result[34][1];
     $t_transformadores = $result[35][1];
     $t_potencia = $result[36][1];
     $t_montaje = $result[37][1];
     $t_refrigeracion = $result[38][1];
     $dm_longitud = $result[43][1];
     $dm_tension = $result[44][1];
     $dm_tipo = $result[45][1];
     $dm_apoyos = $result[46][1];
     $dm_notas = $result[47][1];
     $db_longitu = $result[51][1];
     $db_tension = $result[52][1];
     $db_tipo = $result[53][1];
     $db_apoyos = $result[54][1];
     $db_cajas = $result[55][1];
     $pu_tipo = $result[59][1];
     $pu_estrato = $result[60][1];
     $pu_numero_viviendas = $result[61][1];
     $pu_numero_locales = $result[62][1];
     $pu_zonas_comunes = $result[63][1];
     $pu_metros = $result[64][1];
     $pu_capacidad = $result[65][1];
     $pu_acometidas = $result[66][1];

     if (!empty($nombre_empresa)) {
        $juridica['razon_social'] = $nombre_empresa;
        $juridica['nit'] = $cedula_nit;
        $juridica['nombre_representante'] = $representante;
        $juridica['cedula'] = null;
        $juridica['direccion'] = null; //pendiente
        $juridica['telefono'] = null;
        $juridica['email'] = null;
        $juridica['departamento'] = null;
        $juridica['municipio'] = null;

        Juridica::create($juridica);

     }else {

       $cliente['nit'] = null;
       $cliente['cedula'] = $cedula_nit;
       $cliente['nombre'] = $representante;
       $cliente['telefono'] = null;
       $cliente['direccion'] = null;
       $cliente['email'] = null;
       $cliente['departament'] = null;
       $cliente['municipio']  = null;

       Cliente::create($cliente);

     }

     if (!empty($nombre_empresa)) {
       $juridica = Juridica::all();
       $lastId_juridica = $juridica->last()->id;

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

       $now = new \DateTime();
       $fecha = $now->format('Y-m-d');

       $cotiza['dirigido'] = $dirigido;
       $cotiza['codigo'] = $codigo;
       $cotiza['cliente_id'] = null;
       $cotiza['juridica_id'] = $lastId_juridica;
       $cotiza['fecha'] = $fecha;
       $cotiza['nombre'] = $nombre_proyecto;
       $cotiza['municipio'] = $municipio;
       $cotiza['formas_pago'] =$formas_pago;
       $cotiza['tiempo'] = $tiempo_ejecucion;
       $cotiza['entrega'] = $tiempo_entreda_dictamenes;
       $cotiza['visitas'] = $visitas;
       $cotiza['validez'] = $valides_oferta;
       $cotiza['departamento_id'] = $departamento;
       Cotizacion::create($cotiza);
     }
    }else {
       $cliente = Cliente::all();
       $lastId_cliente = $cliente->last()->id;

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

       $now = new \DateTime();
       $fecha = $now->format('Y-m-d');

       $cotiza['dirigido'] = $dirigido;
       $cotiza['codigo'] = $codigo;
       $cotiza['cliente_id'] = $lastId_cliente;
       $cotiza['juridica_id'] = null;
       $cotiza['fecha'] = $fecha;
       $cotiza['nombre'] = $nombre_proyecto;
       $cotiza['municipio'] = $municipio;
       $cotiza['formas_pago'] =$formas_pago;
       $cotiza['tiempo'] = $tiempo_ejecucion;
       $cotiza['entrega'] = $tiempo_entreda_dictamenes;
       $cotiza['visitas'] = $visitas;
       $cotiza['validez'] = $valides_oferta;
       $cotiza['departamento_id'] = $departamento;

       Cotizacion::create($cotiza);
     }


     if ($t_nivle_tension != 'N.A' && $t_transformadores != 'N.A' && $t_potencia != 'N.A' && $t_montaje != 'N.A') {

       $cotizacion = Cotizacion::all();
       $lastId_cotiza = $cotizacion->last()->id;

      //  $datos = Cotizacion::count('codigo');
      //  $num = Cotizacion::max('codigo');

       $transformacion['descripcion'] = 'Inspección  RETIE proceso de transformación';
       $transformacion['tipo'] = $t_montaje;
       $transformaciones['nivel_tension'] = $t_nivle_tension;
       $transformacion['unidad'] = 'Und';
       $transformacion['capacidad'] = $t_potencia;
       $transformacion['cantidad'] = $t_transformadores;
       $transformacion['tipo_refrigeracion'] = $t_refrigeracion;
       $transformacion['cotizacion_id'] = $lastId_cotiza;

       Transformacion::create($transformacion);

     }else {

     }

     if ($dm_tension != '' && $dm_longitud != '' && $dm_tipo != '' && $dm_apoyos != '' &&  $dm_notas != '') {

       $cotizacion = Cotizacion::all();
       $lastId_cotiza = $cotizacion->last()->id;

       $distrisbucion['descripcion'] = 'Inspección RETIE proceso de distribución en MT';
       $distribucion['tipo'] = $dm_tipo;
       $distribucion['nivel_tension'] = $dm_tension;
       $distribucion['unidad'] = 'Und';
       $distribucion['cantidad'] = $dm_longitud;
       $distribuscion['apoyos'] = $dm_apoyos;
       $distribuscion['apoyos'] = 'N.A';
       $distribucion['cotizacion_id'] = $lastId_cotiza;

       Distribucion::create($distribucion);
     }else {

     }


     if ($db_tension != '' && $db_longitu != '' && $db_tipo != '' && $db_apoyos != '' && $db_cajas != '' ) {

       $cotizacion = Cotizacion::all();
       $lastId_cotiza = $cotizacion->last()->id;

       $distrisbucion['descripcion'] = 'Inspección RETIE proceso de distribución en BT';
       $distribucion['tipo'] = $dm_tipo;
       $distribucion['nivel_tension'] = $dm_tension;
       $distribucion['unidad'] = 'Und';
       $distribucion['cantidad'] = $dm_longitud;
       $distribuscion['apoyos'] = $dm_apoyos;
       $distribuscion['cajas'] = $db_cajas;
       $distribucion['cotizacion_id'] = $lastId_cotiza;

       Distribucion::create($distribucion);


     }else {

     }

    //  $pu_estrato = $result[60][2];
    //  $pu_numero_viviendas = $result[61][2];
    //  $pu_numero_locales = $result[62][2];
    //  $pu_zonas_comunes = $result[63][2];
    //  $pu_metros = $result[64][2];
    //  $pu_capacidad = $result[65][2];
    //  $pu_acometidas = $result[66][2];Inspección RETIE proceso uso final
    //  $pu_tipo = $result[59][2];

     if ($pu_tipo != '' && $pu_estrato != '' && $pu_numero_viviendas != '' && $pu_numero_locales != '' && $pu_zonas_comunes != '' && $pu_metros != '' && $pu_capacidad != '' && $pu_acometidas != '') {

       if ($pu_numero_viviendas != 'N.A') {

         $pu_final['descripcion'] = 'Inspección RETIE proceso uso final '.$pu_tipo;
         $pu_final['tipo'] = null;
         $pu_final['estrato'] = $pu_estrato;
         $pu_final['unidad'] = 'Und';
         $pu_final['cantidad'] = $pu_numero_viviendas;
         $pu_final['metros'] = $pu_metros;

         if ($pu_capacidad == 0) {
           $pu_final['kva'] = 'Según Plano';
         }else {
           $pu_final['kva'] = $pu_capacidad;
         }

         $pu_final['acometidas'] = $pu_acometidas;

         Pu_final::create($pu_final);

       }

       if ($pu_numero_locales != 'N.A') {

         $pu_final['descripcion'] = 'Inspección RETIE proceso uso final '.$pu_tipo;
         $pu_final['tipo'] = null;
         $pu_final['estrato'] = $pu_estrato;
         $pu_final['unidad'] = 'Und';
         $pu_final['cantidad'] = $pu_numero_viviendas;
         $pu_final['metros'] = $pu_metros;

         if ($pu_capacidad == 0) {
           $pu_final['kva'] = 'Según Plano';
         }else {
           $pu_final['kva'] = $pu_capacidad;
         }

         $pu_final['acometidas'] = $pu_acometidas;
         Pu_final::create($pu_final);


       }

       if ($pu_zonas_comunes != 'N.A') {

         $pu_final['descripcion'] = 'Inspección RETIE proceso uso final '.$pu_tipo;
         $pu_final['tipo'] = null;
         $pu_final['estrato'] = $pu_estrato;
         $pu_final['unidad'] = 'Und';
         $pu_final['cantidad'] = $pu_numero_viviendas;
         $pu_final['metros'] = $pu_metros;

         if ($pu_capacidad == 0) {
           $pu_final['kva'] = 'Según Plano';
         }else {
           $pu_final['kva'] = $pu_capacidad;
         }

         $pu_final['acometidas'] = $pu_acometidas;
         Pu_final::create($pu_final);


       }
     }
       return redirect()->route('cotizaciones.index');
   }



  }
