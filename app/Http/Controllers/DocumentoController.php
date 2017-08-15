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

class NumeroALetras
{
    private static $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];
    private static $DECENAS = [
        'VENTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];
    private static $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];
    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';
        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }
        $div_decimales = explode('.',$number);
        if(count($div_decimales) > 1){
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
        else if (count($div_decimales) == 1 && $forzarCentimos){
            $decimales = 'CERO ';
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if(empty($decimales)){
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda) . ' CON ' . $decimales . ' ' . strtoupper($centimos);
        }
        return $valor_convertido;
    }
    private static function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
}

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
      if (file_exists(public_path().'/documento'.'/temp_contrato.html')) {
        unlink(public_path().'/documento'.'/temp_contrato.html');
      }

      $document = new TemplateProcessor($main);
      $firma = public_path().'/firma.jpg';

      $contrato = Administrativa::findOrFail(209);

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
        $table .=   '<w:tblW w:w="5000" w:type="pct"/>';
        $table .=   '</w:tblBorders>';
        $table .=  '</w:tblPr>';
        $table .=  '<w:tr>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:rPr>';
        $table .=            '<w:b />';
        $table .=          '</w:rPr>';
        $table .=          '<w:t>INDICE</w:t>';
        $table .=        '</w:r>';
        $table .=     '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:rPr>';
        $table .=            '<w:b />';
        $table .=          '</w:rPr>';
        $table .=          '<w:t>DESCRIPCION</w:t>';
        $table .=        '</w:r>';
        $table .=     '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:rPr>';
        $table .=            '<w:b />';
        $table .=          '</w:rPr>';
        $table .=          '<w:t>CAPACIDAD</w:t>';
        $table .=        '</w:r>';
        $table .=      '</w:p>';
        $table .=    '</w:tc>';
        $table .=    '<w:tc>';
        $table .=      '<w:p>';
        $table .=        '<w:r>';
        $table .=          '<w:rPr>';
        $table .=            '<w:b />';
        $table .=          '</w:rPr>';
        $table .=          '<w:t>CANTIDAD</w:t>';
        $table .=        '</w:r>';
        $table .=      '</w:p>';
        $table .=    '</w:tc>';
        $table .=  '</w:tr>';

        $i = 1;
        foreach ($transformaciones as $key => $transfor) {

          $table .=   '<w:tblPr>';
          $table .=     '<w:tblStyle w:val="TableGrid"/>';
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
        $document->setValue('cedula',$cliente->cedula);
        $document->setValue('representa','Representante Legal');
        $document->setValue('empresa','');
        $document->setValue('nit_empresa','');

      }else {
        $document->setValue('nombres',$juridica->nombre_representante);
        $document->setValue('cedula',$juridica->cedula);
        $document->setValue('representa','Representante Legal');
        $document->setValue('empresa',$juridica->razon_social);
        $document->setValue('nit_empresa',$juridica->nit);
      }


      $document->setValue('departamento',$departamento->nombre);
      $document->setValue('adicional',$cotizacion->adicional);
      $letras = NumeroALetras::convertir($contrato->valor_total_contrato, 'pesos', 'centavos');

      $document->setValue('letras',$letras);
      $valor_total = number_format($contrato->valor_total_contrato,0);
      $document->setValue('valor_total_contrato',$valor_total);


      $document->saveAs('documento/temp_contrato.html');
      $fil = public_path().'/documento'.'/temp_contrato.html';
      $datos = file_get_contents($fil);
      
      $pdf = App::make('dompdf.wrapper');
      $pdf->loadHTML($datos);
      return $pdf->stream();
      // header("Content-Disposition: attachment; filename=documentoeditado.html; charset=iso-8859-1");
      // echo file_get_contents('documentoeditado.html');


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
