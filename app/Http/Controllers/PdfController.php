<?php

namespace App\Http\Controllers;
use App\Administrativa;
use App\Cliente;
use App\Cotizacion;
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
use App\Documento;
use App\Criterio;
use App\Autorizacion;
use App\Descripcion;
use App\Nc;
use App\Dictamen;
use App\Inspector;
use App\Cantidad_autorizada;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use PDF;
use App;
use DB;


class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPdf($id)
    {

      $administrativa = Administrativa::find($id);
      // $admin  = $administrativas->id;


      $departamentos = Departamento::findOrFail($administrativa->departamento_id);

      if (!empty($administrativa->cliente_id)) {
        $clientes = Cliente::findOrFail($administrativa->cliente_id);
      }

      if (!empty($administrativa->juridica_id)) {
        $juridicas = Juridica::findOrFail($administrativa->juridica_id);

      }

      $municipios = Municipio::find($administrativa->municipio);


      $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
      $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
      $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
      $consignaciones = Consignacion::where('consignacion.administrativa_id', '=', $id)->get();
      $cuenta_cobros = Cuenta_cobro::where('cuenta_cobro.administrativa_id', '=', $id)->get();
      $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();
      $observaciones = Observacion::where('observacion.administrativa_id', '=', $id)->get();


  		// $pdf = \PDF::loadView('pdf.show-admin',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipio','adicionales','consignaciones','cuenta_cobros','facturas'));
  		// return $pdf->download('archivo.pdf');

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-admin',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipios','adicionales','consignaciones','cuenta_cobros','facturas','observaciones'));
      return $pdf->stream($administrativa->codigo_proyecto);
    }

    public function viewcontrato()
    {

    }



    public function cotizacionPdf($id)
    {


      $cotizaciones = Cotizacion::find($id);
      // $admin  = $administrativas->id;
      $total = $cotizaciones->subtotal;
      $iva = $cotizaciones->iva;
      $valor_total = $cotizaciones->total;

      $departamentos = Departamento::findOrFail($cotizaciones->departamento_id);

      if (!empty($cotizaciones->cliente_id)) {
        $clientes = Cliente::findOrFail($cotizaciones->cliente_id);
      }

      if (!empty($cotizaciones->juridica_id)) {
        $juridicas = Juridica::findOrFail($cotizaciones->juridica_id);

      }

      $municipios = explode(',',$cotizaciones->municipio);
      $count = count($municipios);
      for ($i=0; $i < $count; $i++) {

        $array_muni[] =  Municipio::where('municipio.id', '=', $municipios[$i])->get();
      }

      $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $id)->get();
      $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $id)->get();

      $numero1 = 5 * count($transformaciones);
      $numero2 = 6 * count($distribuciones);

      $referencia = Documento::findOrFail(14);
      $inicial = Documento::findOrFail(15);
      $inspeccion = Documento::findOrFail(16);
      $pago = Documento::findOrFail(17);
      $pago2 = Documento::findOrFail(29);
      $pago3 = Documento::findOrFail(30);
      $docu = Documento::findOrFail(18);
      $datos = Documento::findOrFail(19);
      $saludo = Documento::findOrFail(20);
      $objeto = Documento::findOrFail(21);


  		// $pdf = \PDF::loadView('pdf.show-admin',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipio','adicionales','consignaciones','cuenta_cobros','facturas'));
  		// return $pdf->download('archivo.pdf');

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-cotizacion',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','array_muni','numero1','numero2','total','iva','valor_total','cotizaciones','referencia','inicial','inspeccion','pago','docu','datos','objeto','saludo','pago2','pago3'));
      return $pdf->stream($cotizaciones->codigo.' - '.$cotizaciones->nombre.'.pdf');

    }

    public function pdfTecnica($id,$tipo){

      // $criterios = Criterio::where('criterios.administrativa_id', '=', $id)->get();
      $criterios = Criterio::where('criterios.administrativa_id', '=', $id)->where('criterios.tipo','=',$tipo)->get();


      foreach ($criterios as $key => $value) {
        $tipox[] = $value->tipo;
      }
      foreach ($criterios as $key => $val) {
        $ids[] = $val->administrativa_id;
      }
      foreach ($criterios as $key => $fech) {
        $array[] = $fech->fecha;
      }

      $fecha = $array[0];

      $contrato = Administrativa::findOrFail($ids[0]);
    
      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-'.$tipox[0],compact('criterios','contrato','fecha'));
      return $pdf->stream('diseño-detallado.pdf');


    }

    public function pdfNc($id){

        $descripciones = Descripcion::where('descripcion.administrativa_id','=',$id)->get();


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.show-ncObra',compact('descripciones'));
        return $pdf->stream('No conformidades.pdf');

        // return view('ncObra.edit',compact('noconformidades','descripcion'));

    }


    public function ncs($id){

        $ncs[] = Nc::where('nc.descripcion_id','=',$id)->get();

        return $ncs;

    }


    public function pdfAutorizacion($id){

      $autorizaciones = Autorizacion::where('autorizacion.administrativa_id','=',$id)->get();
      $contrato = Administrativa::findOrFail($id);
      $nombres = array('Jhon Jairo Escobar Segura','Jairo Ivan Ibarra Ruales','Alejandra Vitali','Juan Manuel Leon S.','Oscar Andres Sanclemente R');
      $cargos = array('Jefe de poyectos','Director tecnico','Gerente administrativa','Gerente general','Presidente');

      foreach ($autorizaciones as $key => $value) {
        
          $cant_id[] = $value->cantidad_autorizada_id;
      }
      
      $cantidades = Cantidad_autorizada::findOrFail($cant_id[0]);
      
      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-autorizacion',compact('autorizaciones','contrato','nombres','cargos','cantidades'));
      $pdf->setPaper('a4','landscape');  
      return $pdf->stream('autorizacion.pdf');
    }

    public function pdfDictamen($id){

        $cantidad_t = 0;
        $cantidad_dm = 0;
        $cantidad_db = 0;

        $dictamenes = Dictamen::where('dictamenes.administrativa_id','=',$id)->get();
        $inspectores = Inspector::all();

        $contrato = Administrativa::findOrFail($id);
        $t = Transformacion::where('transformacion.administrativa_id', '=', $contrato->id)->get();
        $dm = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->where('descripcion','like','%MT%')->get();
        $db = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->where('descripcion','like','%BT%')->get();
        $pu_final = Pu_final::where('pu_final.administrativa_id', '=', $contrato->id)->get();

        foreach ($t as $key => $trans) {

            $cantidad_t = $cantidad_t + $trans->cantidad;

        }
        foreach ($dm as $key => $media) {
            $cantidad_dm = $cantidad_dm + $media->cantidad;
        }
        foreach ($db as $key => $baja) {
            $cantidad_db = $cantidad_db + $baja->cantidad;
        }

        $dictaminado_t = 0;
        $dictaminado_dm = 0;
        $dictaminado_db  = 0;
        $dictaminado_pu = 0;
        $dic_casas = 0;
        $dic_aparta = 0;
        $dic_zonas = 0;
        $dic_locales = 0;
        $dic_bodegas = 0;
        $dic_fijos = 0;

        $dicataminado = Dictamen::where('administrativa_id','=',$contrato->id)->get();

        foreach ($dicataminado as $key => $dic) {
            
            if ($dic->proceso_dic == 'Transformacion') {
                
                $dictaminado_t = $dictaminado_t + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red MT (m)') {
                $dictaminado_dm = $dictaminado_dm + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Red BT (m)') {
               $dictaminado_db = $dictaminado_db + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Casas') {
               $dic_casas = $dic_casas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Apartamentos') {
               $dic_aparta = $dic_aparta + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Zonas comunes') {
               $dic_zonas = $dic_zonas + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Locales comerciales') {
               $dic_locales = $dic_locales + $dic->cantidad;
            }

            if ($dic->proceso_dic == 'Bodegas') {
               $dic_bodegas = $dic_bodegas + $dic->cantidad;
            }
            if ($dic->proceso_dic == 'Puntos fijos') {
               $dic_fijos = $dic_fijos + $dic->cantidad;
            }
        }


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.show-dictamen',compact('dictamenes','contrato','inspectores','cantidad_t','cantidad_dm','cantidad_db','pu_final','dictaminado_t','dictaminado_dm','dictaminado_db','dic_casas','dic_aparta','dic_zonas','dic_locales','dic_bodegas','dic_fijos'));
        $pdf->setPaper('a4','landscape');  
        return $pdf->stream('autorizacion.pdf');

    }
}
