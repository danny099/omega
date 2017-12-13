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

        $descripcion = Descripcion::where('descripcion.administrativa_id','=',$id);
        $noconformidades = Nc::where('nc.descripcion_id','=',$descripcion->id);

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.show-ncObra',compact('descripcion','noconformidades'));
        return $pdf->stream('No conformidades.pdf');

        // return view('ncObra.edit',compact('noconformidades','descripcion'));

    }

    public function pdfAutorizacion($id){

      $autorizaciones = Autorizacion::where('autorizacion.administrativa_id','=',$id)->get();
      $contrato = Administrativa::findOrFail($id);

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-autorizacion',compact('autorizaciones','contrato'));
      $pdf->setPaper('a4','landscape');  
      return $pdf->stream('autorizacion.pdf');
    }
}
