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
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use PDF;
use App;

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



    public function cotizacionPdf($id)
    {


      $cotizaciones = Cotizaciones::find($id);
      // $admin  = $administrativas->id;


      $departamentos = Departamento::findOrFail($cotizaciones->departamento_id);

      if (!empty($cotizaciones->cliente_id)) {
        $clientes = Cliente::findOrFail($cotizaciones->cliente_id);
      }

      if (!empty($cotizaciones->juridica_id)) {
        $juridicas = Juridica::findOrFail($cotizaciones->juridica_id);

      }

      $municipios = Municipio::find($cotizaciones->municipio);



      $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $id)->get();
      $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $id)->get();




  		// $pdf = \PDF::loadView('pdf.show-admin',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipio','adicionales','consignaciones','cuenta_cobros','facturas'));
  		// return $pdf->download('archivo.pdf');

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadView('pdf.show-cotizacion',compact('administrativa','clientes','juridicas','otrosis','distribuciones','transformaciones','pu_finales','departamentos','municipios'));
      return $pdf->stream('pdf-cotizacion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
