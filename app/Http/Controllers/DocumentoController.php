<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Cotizacion;
use App\Cliente;
use App\Administrativa;
use App\Transformacion;
use App\Distribucion;
use App\Pu_final;
use App\Juridica;
use App\Municipio;
use App\Departamento;
use Session;
use PDF;
use App;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();

        return view('documentos.index',compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documentos.create');
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
        $documetos['detalles'] = $request->editor1;
        $documetos['nombre'] = $request->nombre;

        Documento::create($documetos);

        Session::flash('message', 'Contrato editado!');
        Session::flash('class', 'success');
        return redirect()->route('documentos.index');

    }

    public function cotizacion(){ // tiene que mandar el id para poder encontrar al que se deba generar

      $cotizacion = Cotizacion::findOrFail(204);

      if (file_exists(public_path().'/documento'.'/temp.html')) {
        unlink(public_path().'/documento'.'/temp.html');
      }

      $main = public_path().'/documento'.'/cotizacion_main.html';
      copy(public_path().'/documento'.'/cotizacion_main.html', public_path().'/documento'.'/temp.html');
      $archivo = public_path().'/documento'.'/temp.html';
      $datos = file_get_contents($archivo);

      $transformaciones = Transformacion::all();

      $tabla1 = "<table>".
                 "<tr>".
                   "<th colspan='6' class='ttable'>ALCANCE DE TRANSFORMACIÓN</th>".
                 "</tr>".
                 "<thead>".
                   "<tr>".
                     "<th>Descripción</th>".
                     "<th>Tipo</th>".
                     "<th>Nivel de Tensión (KV)</th>".
                     "<th>Capacidad (KVA)</th>".
                     "<th>Cantidad</th>".
                     "<th>Tipo de Refrigeración</th>".
                   "</tr>".
                 "</thead>".
                 "<tbody>";
                 foreach ($transformaciones as $key => $transfor){
          $tabla1.= "<tr>".
                     "<td>" .$transfor->descripcion. "</td>".
                     "<td>" .$transfor->tipo. "</td>".
                     "<td>" .$transfor->nivel_tension. "</td>".
                     "<td>" .$transfor->capacidad. " KVA</td>".
                     "<td>" .$transfor->cantidad. " Und</td>".
                     "<td>" .$transfor->tipo_refrigeracion. "</td>".
                   "</tr>";
                 }
                 $tabla1.="</tbody>".
               "</table>";

      $datos = str_replace('Ã±','ñ',str_replace('#dirigido#',$cotizacion->dirigido,$datos));
      $datos = str_replace('#codigo#',$cotizacion->codigo,$datos);
      $datos = str_replace('#cliente_id#',$cotizacion->cliente_id,$datos);
      $datos = str_replace('#juridica_id#',$cotizacion->juridica_id,$datos);
      $datos = str_replace('#fecha#',$cotizacion->fecha,$datos);
      $datos = str_replace('#nombre#',$cotizacion->nombre,$datos);
      $datos = str_replace('#municipio#',$cotizacion->municipio,$datos);
      $datos = str_replace('#departamento_id#',$cotizacion->departamento_id,$datos);
      $datos = str_replace('#formas_pago#',$cotizacion->formas_pago,$datos);
      $datos = str_replace('#tiempo#',$cotizacion->tiempo,$datos);
      $datos = str_replace('#entrega#',$cotizacion->entrega,$datos);
      $datos = str_replace('#visitas#',$cotizacion->visitas,$datos);
      $datos = str_replace('#validez#',$cotizacion->validez,$datos);
      $datos = str_replace('#subtotal#',$cotizacion->subtotal,$datos);
      $datos = str_replace('#iva#',$cotizacion->iva,$datos);
      $datos = str_replace('#total#',$cotizacion->total,$datos);
      $datos = str_replace('#adicional#',$cotizacion->adicional,$datos);
      $datos = str_replace('#observaciones#',$cotizacion->observaciones,$datos);
      $datos = str_replace('#tabla1#',$tabla1,$datos);



      $file = fopen($archivo,'w');

      fputs($file, utf8_decode($datos));
      fclose($file);

      $pdf = App::make('dompdf.wrapper');
      $pdf->loadHTML($datos);
      return $pdf->download();

    }

    public function contrato(){ // tiene que mandar el id para poder encontrar al que se deba generar


      $main = public_path().'/documento'.'/contrato_main.docx';
      // $PHPWord = new \PhpOffice\PhpWord\PhpWord();
      $document = new TemplateProcessor($main);


      $contrato = Administrativa::findOrFail(208);

      if (!is_null($contrato->cliente_id)) {
        $cliente = Cliente::findOrFail($contrato->cliente_id);
      }
      if (!is_null($contrato->juridica_id)) {
        $juridica = Juridica::findOrFail($contrato->juridica_id);
      }


      // $cotizacion = Cotizacion::where('cotizacion.cliente_id', '=', $contrato->id_cotizacion)->get();
      $cotizacion = Cotizacion::findOrFail($contrato->id_cotizacion);

      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $contrato->id)->get();
      $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->get();
      $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $contrato->id)->get();
      $municipio = Municipio::find($contrato->municipio);
      $departamento = Departamento::find($contrato->departamento_id);

      $table = '';
      $table .= '<w:tbl>';
        $table .= '<w:tblPr>';
        $table .=   '<w:tblBorders>';
        $table .=     '<w:top w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=     '<w:start w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=     '<w:bottom w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=     '<w:end w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=     '<w:insideH w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=     '<w:insideV w:val="single" w:sz="8" w:space="0" w:color="000000" />';
        $table .=   '</w:tblBorders>';
        $table .=  '</w:tblPr>';
        $table .=  '<w:tr>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:t>Indice</w:t>';
        $table .=        '</w:r>';
        $table .=     '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:t>Descripcion</w:t>';
        $table .=        '</w:r>';
        $table .=     '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:t>Capacidad</w:t>';
        $table .=        '</w:r>';
        $table .=      '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:t>Cantidad</w:t>';
        $table .=        '</w:r>';
        $table .=      '</w:p>';
        $table .=    '</w:tc>';
        $table .=  '</w:tr>';

        $i = 0;
        foreach ($transformaciones as $key => $transfor) {

          $table .=   '<w:tblPr>';
          $table .=     '<w:tblStyle w:val="TableGrid"/>';
          $table .=     '<w:tblW w:w="0" w:type="auto"/>';
          $table .=   '</w:tblPr>';
          $table .=  '<w:tr>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$i++.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$transfor->descripcion.' '.$transfor->tipo.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$transfor->unidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$transfor->cantidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=  '</w:tr>';
        }
        foreach ($distribuciones as $key => $distri) {

          $table .=   '<w:tblPr>';
          $table .=     '<w:tblStyle w:val="TableGrid"/>';
          $table .=     '<w:tblW w:w="0" w:type="auto"/>';
          $table .=   '</w:tblPr>';
          $table .=  '<w:tr>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$i++.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$distri->descripcion.' '.$distri->tipo.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$distri->unidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$distri->cantidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=  '</w:tr>';
        }
        foreach ($pu_finales as $key => $pu) {

          $table .=   '<w:tblPr>';
          $table .=     '<w:tblStyle w:val="TableGrid"/>';
          $table .=     '<w:tblW w:w="0" w:type="auto"/>';
          $table .=   '</w:tblPr>';
          $table .=  '<w:tr>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$i++.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$pu->descripcion.' '.$pu->tipo.'</w:t>';
          $table .=        '</w:r>';
          $table .=     '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$pu->unidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=    '<w:tc>';
          $table .=      '<w:p>';
          $table .=        '<w:r>';
          $table .=          '<w:t>'.$pu->cantidad.'</w:t>';
          $table .=        '</w:r>';
          $table .=      '</w:p>';
          $table .=    '</w:tc>';
          $table .=  '</w:tr>';
        }
      $table .= '</w:tbl>';


      $document->setValue('codigo',$contrato->codigo_proyecto);

      if (!is_null($contrato->cliente_id)) {
        $document->setValue('cliente',$cliente->nombre);
      }else {
        $document->setValue('cliente',$juridica->nombre_representante);
      }

      if (!is_null($contrato->cliente_id)) {
        if (!is_null($cliente->cedula)) {
          $document->setValue('marca','C.C:');
          $document->setValue('nit',$cliente->cedula);
        }else {
          $document->setValue('marca','NIT:');
          $document->setValue('nit',$cliente->nit);
        }
      }else {
        $document->setValue('marca','NIT:');
        $document->setValue('nit',$juridica->nit);
      }

      $document->setValue('table',$table);
      $document->setValue('nombre_proyecto',$contrato->nombre_proyecto);
      $document->setValue('municipio',$municipio->nombre);

      if (!is_null($contrato->cliente_id)) {
        $document->setValue('nombres',$cliente->nombre);
      }else {
        $document->setValue('nombres',$juridica->nombre_representante);
      }
      if (!is_null($contrato->cliente_id)) {
        $document->setValue('cedula',$cliente->cedula);
      }else {
        $document->setValue('cedula',$juridica->cedula);
      }

      $document->setValue('departamento',$departamento->nombre);
      $document->setValue('adicional',$cotizacion->adicional);



      $document->saveAs('documentoeditado.docx');
      header("Content-Disposition: attachment; filename=documentoeditado.docx; charset=iso-8859-1");
      echo file_get_contents('documentoeditado.docx');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento = Documento::find($id);
        return view('documentos.edit',compact('documento'));
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
        $datos['nombre'] = $request->nombre;
        $datos['detalles'] = $request->editor1;

        $documento = Documento::findOrFail($id);

        $documento->update($datos);
        Session::flash('message', 'Contrato editado!');
        Session::flash('class', 'success');
        return redirect()->route('documentos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documeto = Documento::findOrFail($id);
        Session::flash('message', 'Documento eliminado');
        Session::flash('class', 'danger');
        $documeto->delete();
        return redirect('documentos');
    }
}
