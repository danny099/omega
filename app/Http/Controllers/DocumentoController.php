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
use Response;
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
      $documentos = Documento::where('documentos.tipo', '=', 'cotizacion')->get();


        return view('documentos.index',compact('documentos'));
    }

    public function indexContrato()
    {
      $documentos = Documento::where('documentos.tipo', '=', 'contrato')->get();

      return view('documentoscon.index',compact('documentos'));
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

    public function crearcontrato()
    {
      return view('documentoscon.create');
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

        if (!empty($request->tipo)) {
          $documetos['detalles'] = $request->editor1;
          $documetos['nombre'] = $request->nombre;
          $documetos['tipo'] = 'contrato';

          Documento::create($documetos);

          Session::flash('message', 'Contrato editado!');
          Session::flash('class', 'success');
          return redirect('documentoscon');
        }else {
          $documetos['detalles'] = $request->editor1;
          $documetos['nombre'] = $request->nombre;
          $documetos['tipo'] = 'cotizacion';

          Documento::create($documetos);

          Session::flash('message', 'Contrato editado!');
          Session::flash('class', 'success');
          return redirect()->route('documentos.index');
        }

    }



    public function cotizacion($id){ // tiene que mandar el id para poder encontrar al que se deba generar

      // $main = public_path().'/documento'.'/cotizacion.docx';
      //
      // $document = new TemplateProcessor($main);
      // $firma = public_path().'/firma.jpg';
      //
      // $cotizacion = Cotizacion::findOrFail($id);
      // $total = $cotizacion->subtotal;
      // $iva = $cotizacion->iva;
      // $valor_total = $cotizacion->total;
      //
      // if (!is_null($cotizacion->cliente_id)) {
      //   $cliente = Cliente::findOrFail($cotizacion->cliente_id);
      // }
      // if (!is_null($cotizacion->juridica_id)) {
      //   $juridica = Juridica::findOrFail($cotizacion->juridica_id);
      // }
      //
      // $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $cotizacion->id)->get();
      // $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $cotizacion->id)->get();
      // $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $cotizacion->id)->get();
      // $municipio = Municipio::find($cotizacion->municipio);
      // $departamento = Departamento::find($cotizacion->departamento_id);
      //
      // if (!empty($transformaciones)) {
      //   $table = '';
      //   $table .= '<w:tbl>';
      //     $table .= '<w:tblPr>';
      //     $table .=   '<w:tblBorders>';
      //     $table .=     '<w:top w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=     '<w:start w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=     '<w:bottom w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=     '<w:end w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=     '<w:insideH w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=     '<w:insideV w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table .=   '<w:tblW w:w="0" w:type="pct"/>';
      //     $table .=   '</w:tblBorders>';
      //     $table .=  '</w:tblPr>';
      //     $table .=        '<w:rPr>';
      //     $table .=          '<w:rFonts w:ascii="Courier New"/>';
      //     $table .=        '</w:rPr>';
      //     $table .=  '<w:tr>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:tcPr>';
      //     $table .=        '<w:tcW w:w="4122" w:type="dxa"/>';
      //     $table .=        '<w:gridSpan w:val="6"/>';
      //     $table .=        '<w:shd w:val="clear" w:color="auto" w:fill="D6E3BC" w:themeFill="accent3" w:themeFillTint="66"/>';
      //     $table .=      '</w:tcPr>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Transformación</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=     '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=  '</w:tr>';
      //     $table .=  '<w:tr>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=         '<w:tcPr>';
      //     $table .=         '<w:tcW w:w="3000" w:type="dxa"/>';
      //     $table .=         '</w:tcPr>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Descripción</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=     '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Tipo</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=      '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=       '<w:tcPr>';
      //     $table .=         '<w:tcW w:w="3000" w:type="dxa"/>';
      //     $table .=       '</w:tcPr>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Nivel de tensión</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=      '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Capacidad</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=      '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Cantidad</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=      '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=    '<w:tc>';
      //     $table .=      '<w:p>';
      //     $table .=        '<w:pPr>';
      //     $table .=           '<w:jc w:val="center"/>';
      //     $table .=        '</w:pPr>';
      //     $table .=        '<w:r>';
      //     $table .=       '<w:tcPr>';
      //     $table .=         '<w:tcW w:w="2000" w:type="dxa"/>';
      //     $table .=       '</w:tcPr>';
      //     $table .=          '<w:rPr>';
      //     $table .=            '<w:b />';
      //     $table .=            '<w:sz w:val="18"/>';
      //     $table .=          '</w:rPr>';
      //     $table .=          '<w:t>Refrigeración</w:t>';
      //     $table .=        '</w:r>';
      //     $table .=      '</w:p>';
      //     $table .=    '</w:tc>';
      //     $table .=  '</w:tr>';
      //
      //     $i = 1;
      //     foreach ($transformaciones as $key => $transfor) {
      //
      //       $table .=   '<w:tblPr>';
      //       $table .=     '<w:tblStyle w:val="TableGrid"/>';
      //       $table .=   '</w:tblPr>';
      //       $table .=  '<w:tr>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->descripcion.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=     '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->tipo.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=      '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->nivel_tension.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=      '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->capacidad.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=      '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->cantidad.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=      '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=    '<w:tc>';
      //       $table .=      '<w:p>';
      //       $table .=        '<w:pPr>';
      //       $table .=           '<w:jc w:val="center"/>';
      //       $table .=        '</w:pPr>';
      //       $table .=        '<w:r>';
      //       $table .=          '<w:t>'.$transfor->tipo_refrigeracion.'</w:t>';
      //       $table .=        '</w:r>';
      //       $table .=      '</w:p>';
      //       $table .=    '</w:tc>';
      //       $table .=  '</w:tr>';
      //     }
      //   $table .= '</w:tbl>';
      // }
      //
      // if (!empty($distribuciones)) {
      //   $table2 = '';
      //   $table2 .= '<w:tbl>';
      //     $table2 .= '<w:tblPr>';
      //     $table2 .=   '<w:tblBorders>';
      //     $table2 .=     '<w:top w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=     '<w:start w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=     '<w:bottom w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=     '<w:end w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=     '<w:insideH w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=     '<w:insideV w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table2 .=   '<w:tblW w:w="5000" w:type="pct"/>';
      //     $table2 .=   '</w:tblBorders>';
      //     $table2 .=  '</w:tblPr>';
      //     $table2 .=  '<w:tr>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:tcPr>';
      //     $table2 .=        '<w:tcW w:w="4122" w:type="dxa"/>';
      //     $table2 .=        '<w:gridSpan w:val="7"/>';
      //     $table2 .=        '<w:shd w:val="clear" w:color="auto" w:fill="D6E3BC" w:themeFill="accent3" w:themeFillTint="66"/>';
      //     $table2 .=      '</w:tcPr>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Distribución</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=     '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=  '</w:tr>';
      //     $table2 .=  '<w:tr>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Descripción</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=     '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Tipo</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Nivel de tensión</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Cantidad</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Apoyos</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Cajas</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=    '<w:tc>';
      //     $table2 .=      '<w:p>';
      //     $table2 .=        '<w:pPr>';
      //     $table2 .=           '<w:jc w:val="center"/>';
      //     $table2 .=        '</w:pPr>';
      //     $table2 .=        '<w:r>';
      //     $table2 .=          '<w:rPr>';
      //     $table2 .=            '<w:b />';
      //     $table2 .=            '<w:sz w:val="18"/>';
      //     $table2 .=          '</w:rPr>';
      //     $table2 .=          '<w:t>Notas</w:t>';
      //     $table2 .=        '</w:r>';
      //     $table2 .=      '</w:p>';
      //     $table2 .=    '</w:tc>';
      //     $table2 .=  '</w:tr>';
      //
      //     $i = 1;
      //     foreach ($distribuciones as $key => $distri) {
      //
      //       $table2 .=   '<w:tblPr>';
      //       $table2 .=     '<w:tblStyle w:val="TableGrid"/>';
      //       $table2 .=     '<w:tblW w:w="0" w:type="auto"/>';
      //       $table2 .=   '</w:tblPr>';
      //       $table2 .=  '<w:tr>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->descripcion.'</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=     '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->tipo.'</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=      '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->nivel_tension.'</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=      '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->cantidad.' mts</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=      '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->apoyos.'</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=      '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       $table2 .=    '<w:tc>';
      //       $table2 .=      '<w:p>';
      //       $table2 .=        '<w:pPr>';
      //       $table2 .=           '<w:jc w:val="center"/>';
      //       $table2 .=        '</w:pPr>';
      //       $table2 .=        '<w:r>';
      //       $table2 .=          '<w:t>'.$distri->cajas.'</w:t>';
      //       $table2 .=        '</w:r>';
      //       $table2 .=      '</w:p>';
      //       $table2 .=    '</w:tc>';
      //       if ($distri->notas == null) {
      //         $table2 .=    '<w:tc>';
      //         $table2 .=      '<w:p>';
      //         $table2 .=        '<w:pPr>';
      //         $table2 .=           '<w:jc w:val="center"/>';
      //         $table2 .=        '</w:pPr>';
      //         $table2 .=        '<w:r>';
      //         $table2 .=          '<w:t>N.A</w:t>';
      //         $table2 .=        '</w:r>';
      //         $table2 .=      '</w:p>';
      //         $table2 .=    '</w:tc>';
      //       }else {
      //         $table2 .=    '<w:tc>';
      //         $table2 .=      '<w:p>';
      //         $table2 .=        '<w:pPr>';
      //         $table2 .=           '<w:jc w:val="center"/>';
      //         $table2 .=        '</w:pPr>';
      //         $table2 .=        '<w:r>';
      //         $table2 .=          '<w:t>'.$distri->notas.'</w:t>';
      //         $table2 .=        '</w:r>';
      //         $table2 .=      '</w:p>';
      //         $table2 .=    '</w:tc>';
      //       }
      //       $table2 .=  '</w:tr>';
      //     }
      //
      //   $table2 .= '</w:tbl>';
      // }
      //
      // if (!empty($pu_finales)) {
      //   $table3 = '';
      //   $table3 .= '<w:tbl>';
      //     $table3 .= '<w:tblPr>';
      //     $table3 .=   '<w:tblBorders>';
      //     $table3 .=     '<w:top w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=     '<w:start w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=     '<w:bottom w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=     '<w:end w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=     '<w:insideH w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=     '<w:insideV w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //     $table3 .=   '<w:tblW w:w="5000" w:type="pct"/>';
      //     $table3 .=   '</w:tblBorders>';
      //     $table3 .=  '</w:tblPr>';
      //     $table3 .=  '<w:tr>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:tcPr>';
      //     $table3 .=        '<w:tcW w:w="422" w:type="dxa"/>';
      //     $table3 .=        '<w:gridSpan w:val="7"/>';
      //     $table3 .=        '<w:shd w:val="clear" w:color="auto" w:fill="D6E3BC" w:themeFill="accent3" w:themeFillTint="66"/>';
      //     $table3 .=      '</w:tcPr>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Uso Final</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=     '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=  '</w:tr>';
      //     $table3 .=  '<w:tr>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Descripción</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=     '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3.=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Tipo</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3.=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Estrato</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Nivel de tensión</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Capacidad</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Cantidad</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=    '<w:tc>';
      //     $table3 .=      '<w:p>';
      //     $table3 .=        '<w:pPr>';
      //     $table3 .=           '<w:jc w:val="center"/>';
      //     $table3 .=        '</w:pPr>';
      //     $table3 .=        '<w:r>';
      //     $table3 .=          '<w:rPr>';
      //     $table3 .=            '<w:b />';
      //     $table3 .=            '<w:sz w:val="18"/>';
      //     $table3 .=          '</w:rPr>';
      //     $table3 .=          '<w:t>Acometidas</w:t>';
      //     $table3 .=        '</w:r>';
      //     $table3 .=      '</w:p>';
      //     $table3 .=    '</w:tc>';
      //     $table3 .=  '</w:tr>';
      //
      //     $i = 1;
      //     foreach ($pu_finales as $key => $pu) {
      //
      //       $table3 .=   '<w:tblPr>';
      //       $table3 .=     '<w:tblStyle w:val="TableGrid"/>';
      //       $table3 .=     '<w:tblW w:w="0" w:type="auto"/>';
      //       $table3 .=   '</w:tblPr>';
      //       $table3 .=  '<w:tr>';
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->descripcion.'</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=     '</w:p>';
      //       $table3 .=    '</w:tc>';
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->tipo.'</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=      '</w:p>';
      //       $table3 .=    '</w:tc>';
      //       if ($pu->estrato == null) {
      //         $table3 .=    '<w:tc>';
      //         $table3 .=      '<w:p>';
      //         $table3 .=        '<w:pPr>';
      //         $table3 .=           '<w:jc w:val="center"/>';
      //         $table3 .=        '</w:pPr>';
      //         $table3 .=        '<w:r>';
      //         $table3 .=          '<w:t>N.A</w:t>';
      //         $table3 .=        '</w:r>';
      //         $table3 .=      '</w:p>';
      //         $table3 .=    '</w:tc>';
      //       }else {
      //         $table3 .=    '<w:tc>';
      //         $table3 .=      '<w:p>';
      //         $table3 .=        '<w:pPr>';
      //         $table3 .=           '<w:jc w:val="center"/>';
      //         $table3 .=        '</w:pPr>';
      //         $table3 .=        '<w:r>';
      //         $table3 .=          '<w:t>'.$pu->estrato.'</w:t>';
      //         $table3 .=        '</w:r>';
      //         $table3 .=      '</w:p>';
      //         $table3 .=    '</w:tc>';
      //       }
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->cantidad.' Und</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=      '</w:p>';
      //       $table3 .=    '</w:tc>';
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->metros.'</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=      '</w:p>';
      //       $table3 .=    '</w:tc>';
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->kva.' KVA</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=      '</w:p>';
      //       $table3 .=    '</w:tc>';
      //       $table3 .=    '<w:tc>';
      //       $table3 .=      '<w:p>';
      //       $table3 .=        '<w:pPr>';
      //       $table3 .=           '<w:jc w:val="center"/>';
      //       $table3 .=        '</w:pPr>';
      //       $table3 .=        '<w:r>';
      //       $table3 .=          '<w:t>'.$pu->acometidas.'</w:t>';
      //       $table3 .=        '</w:r>';
      //       $table3 .=      '</w:p>';
      //       $table3 .=    '</w:tc>';
      //
      //       $table3 .=  '</w:tr>';
      //     }
      //
      //   $table3 .= '</w:tbl>';
      // }
      //
      //
      // $table4 = '';
      // $table4 .= '<w:tbl>';
      //   $table4 .= '<w:tblPr>';
      //   $table4 .=   '<w:tblBorders>';
      //   $table4 .=     '<w:top w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=     '<w:start w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=     '<w:bottom w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=     '<w:end w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=     '<w:insideH w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=     '<w:insideV w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table4 .=   '<w:tblW w:w="4500" w:type="pct"/>';
      //   $table4 .=   '</w:tblBorders>';
      //   $table4 .=   '<w:jc w:val="center"/>';
      //   $table4 .=  '</w:tblPr>';
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:tcW w:w="4122" w:type="dxa"/>';
      //   $table4 .=        '<w:gridSpan w:val="4"/>';
      //   $table4 .=        '<w:shd w:val="clear" w:color="auto" w:fill="D6E3BC" w:themeFill="accent3" w:themeFillTint="66"/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Cotización</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Ítem</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Descripción del alcance</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4.=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Cantidad</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t></w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      //
      //
      //   $i = 1;
      //   foreach ($transformaciones as $key => $trans) {
      //
      //     $table4 .=   '<w:tblPr>';
      //     $table4 .=     '<w:tblStyle w:val="TableGrid"/>';
      //     $table4 .=     '<w:tblW w:w="0" w:type="auto"/>';
      //     $table4 .=   '</w:tblPr>';
      //     $table4 .=  '<w:tr>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:rPr>';
      //     $table4 .=            '<w:b />';
      //     $table4 .=          '</w:rPr>';
      //     $table4 .=          '<w:t>'.$i++.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$trans->descripcion.' - '.$trans->tipo.' - Capacidad: '.$trans->capacidad.' KVA</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$trans->cantidad.' '.$trans->unidad.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:tcPr>';
      //     $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //     $table4 .=        '<w:vMerge/>';
      //     $table4 .=      '</w:tcPr>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.number_format($total,0).'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=  '</w:tr>';
      //   }
      //   foreach ($distribuciones as $key => $distri) {
      //
      //     $table4 .=   '<w:tblPr>';
      //     $table4 .=     '<w:tblStyle w:val="TableGrid"/>';
      //     $table4 .=     '<w:tblW w:w="0" w:type="auto"/>';
      //     $table4 .=   '</w:tblPr>';
      //     $table4 .=  '<w:tr>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:rPr>';
      //     $table4 .=            '<w:b />';
      //     $table4 .=          '</w:rPr>';
      //     $table4 .=          '<w:t>'.$i++.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$distri->descripcion.' - '.$distri->tipo.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$distri->cantidad.' '.$distri->unidad.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:tcPr>';
      //     $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //     $table4 .=        '<w:vMerge/>';
      //     $table4 .=      '</w:tcPr>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t></w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=  '</w:tr>';
      //   }
      //   foreach ($pu_finales as $key => $pu) {
      //
      //     $table4 .=   '<w:tblPr>';
      //     $table4 .=     '<w:tblStyle w:val="TableGrid"/>';
      //     $table4 .=     '<w:tblW w:w="0" w:type="auto"/>';
      //     $table4 .=   '</w:tblPr>';
      //     $table4 .=  '<w:tr>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:rPr>';
      //     $table4 .=            '<w:b />';
      //     $table4 .=          '</w:rPr>';
      //     $table4 .=          '<w:t>'.$i++.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$pu->descripcion.' - '.$pu->tipo.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=     '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t>'.$pu->cantidad.' '.$pu->unidad.'</w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=    '<w:tc>';
      //     $table4 .=      '<w:tcPr>';
      //     $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //     $table4 .=        '<w:vMerge/>';
      //     $table4 .=      '</w:tcPr>';
      //     $table4 .=      '<w:p>';
      //     $table4 .=        '<w:pPr>';
      //     $table4 .=           '<w:jc w:val="center"/>';
      //     $table4 .=        '</w:pPr>';
      //     $table4 .=        '<w:r>';
      //     $table4 .=          '<w:t></w:t>';
      //     $table4 .=        '</w:r>';
      //     $table4 .=      '</w:p>';
      //     $table4 .=    '</w:tc>';
      //     $table4 .=  '</w:tr>';
      //   }
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //   $table4 .=        '<w:vMerge/>';
      //   $table4 .=        '<w:gridSpan w:val="2"/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t></w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=            '<w:sz w:val="20"/>';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Costo directo inspección Eléctrica:</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t>'.number_format($total,0).'</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //   $table4 .=        '<w:gridSpan w:val="2"/>';
      //   $table4 .=        '<w:vMerge/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t></w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=            '<w:sz w:val="20"/>';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>IVA (19%):</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t>'.number_format($iva,0).'</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //   $table4 .=        '<w:vMerge/>';
      //   $table4 .=        '<w:gridSpan w:val="2"/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t></w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:shd w:val="clear" w:color="auto" w:fill="F2F2F2 "/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=            '<w:sz w:val="20"/>';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Valor Total del Proyecto:</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:shd w:val="clear" w:color="auto" w:fill="F2F2F2 "/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t>'.number_format($valor_total,0).'</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      //   $table4 .=  '<w:tr>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:tcPr>';
      //   $table4 .=        '<w:tcW w:w="1800" w:type="dxa"/>';
      //   $table4 .=        '<w:vMerge/>';
      //   $table4 .=        '<w:gridSpan w:val="2"/>';
      //   $table4 .=      '</w:tcPr>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t></w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:rPr>';
      //   $table4 .=            '<w:b />';
      //   $table4 .=            '<w:sz w:val="20"/>';
      //   $table4 .=          '</w:rPr>';
      //   $table4 .=          '<w:t>Costo Adicional de Visita por día si se requiere:</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=     '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=    '<w:tc>';
      //   $table4 .=      '<w:p>';
      //   $table4 .=        '<w:pPr>';
      //   $table4 .=           '<w:jc w:val="center"/>';
      //   $table4 .=        '</w:pPr>';
      //   $table4 .=        '<w:r>';
      //   $table4 .=          '<w:t>'.number_format($cotizacion->adicional,0).'</w:t>';
      //   $table4 .=        '</w:r>';
      //   $table4 .=      '</w:p>';
      //   $table4 .=    '</w:tc>';
      //   $table4 .=  '</w:tr>';
      // $table4 .= '</w:tbl>';
      //
      // $table5 = '';
      // $table5 .= '<w:tbl>';
      //   $table5 .= '<w:tblPr>';
      //   $table5 .=   '<w:tblBorders>';
      //   $table5 .=     '<w:top w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=     '<w:start w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=     '<w:bottom w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=     '<w:end w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=     '<w:insideH w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=     '<w:insideV w:val="single" w:sz="1" w:space="0" w:color="000000" />';
      //   $table5 .=   '<w:tblW w:w="5000" w:type="pct"/>';
      //   $table5 .=   '</w:tblBorders>';
      //   $table5 .=  '</w:tblPr>';
      //   $table5 .=  '<w:tr>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:rPr>';
      //   $table5 .=            '<w:b />';
      //   $table5 .=            '<w:sz w:val="25"/>';
      //   $table5 .=          '</w:rPr>';
      //   $table5 .=          '<w:t>Formas de pago</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=     '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:t>'.$cotizacion->formas_pago.'</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=     '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=  '</w:tr>';
      //   $table5 .=  '<w:tr>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5.=          '<w:rPr>';
      //   $table5 .=            '<w:b />';
      //   $table5 .=            '<w:sz w:val="25"/>';
      //   $table5 .=          '</w:rPr>';
      //   $table5 .=          '<w:t>Tiempo de ejecución</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:t>'.$cotizacion->tiempo.'</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=  '</w:tr>';
      //   $table5 .=  '<w:tr>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5.=          '<w:rPr>';
      //   $table5 .=            '<w:b />';
      //   $table5 .=            '<w:sz w:val="25"/>';
      //   $table5 .=          '</w:rPr>';
      //   $table5 .=          '<w:t>Tiempo de entrega del dictamen</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:t>'.$cotizacion->entrega.' una vez se encuentre la documentación completa y no se tenga NC abiertas</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=  '</w:tr>';
      //   $table5 .=  '<w:tr>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:rPr>';
      //   $table5 .=            '<w:b />';
      //   $table5 .=            '<w:sz w:val="25"/>';
      //   $table5 .=          '</w:rPr>';
      //   $table5 .=          '<w:t>Número de visitas de inspección  contratadas</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:t>'.$cotizacion->visitas.'</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=  '</w:tr>';
      //   $table5 .=  '<w:tr>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:rPr>';
      //   $table5 .=            '<w:b />';
      //   $table5 .=            '<w:sz w:val="25"/>';
      //   $table5 .=          '</w:rPr>';
      //   $table5 .=          '<w:t>Validez de la oferta</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=    '<w:tc>';
      //   $table5 .=      '<w:p>';
      //   $table5 .=        '<w:r>';
      //   $table5 .=          '<w:t>'.$cotizacion->validez.'</w:t>';
      //   $table5 .=        '</w:r>';
      //   $table5 .=      '</w:p>';
      //   $table5 .=    '</w:tc>';
      //   $table5 .=  '</w:tr>';
      // $table5 .= '</w:tbl>';
      //
      //
      // $document->setValue('codigo',$cotizacion->codigo);
      // $document->setValue('fecha',$cotizacion->fecha);
      //
      // if (!is_null($cotizacion->cliente_id)) {
      //   $document->setValue('cliente',$cliente->nombre);
      //   $document->setValue('nit',$cliente->cedula);
      // }else {
      //   $document->setValue('cliente',$juridica->nombre_representante);
      //   $document->setValue('nit',$juridica->nit);
      // }
      //
      // // if (!is_null($cotizacion->cliente_id)) {
      // //   if (!is_null($cliente->cedula)) {
      // //     $document->setValue('marca','C.C:');
      // //     $document->setValue('nit',$cliente->cedula);
      // //   }else {
      // //     $document->setValue('marca','NIT:');
      // //     $document->setValue('nit',$cliente->nit);
      // //   }
      // // }else {
      // //   $document->setValue('marca','NIT:');
      // //   $document->setValue('nit',$juridica->nit);
      // // }
      // $document->setValue('dirigido',$cotizacion->dirigido);
      //   $document->setValue('transformación',$table);
      //   $document->setValue('distribucion',$table2);
      //   $document->setValue('pu_final',$table3);
      //   $document->setValue('propuesta',$table4);
      //   $document->setValue('condiciones',$table5);
      //
      // $document->setValue('nombre_proyecto',$cotizacion->nombre_proyecto);
      // $document->setValue('municipio',$municipio->nombre);
      // $document->setValue('formas_pago',$cotizacion->formas_pago);
      // $document->setValue('tiempo',$cotizacion->tiempo);
      // $document->setValue('entrega',$cotizacion->entrega);
      // $document->setValue('visitas',$cotizacion->visitas);
      // $document->setValue('validez',$cotizacion->validez);
      //
      // $document->setValue('departamento',$departamento->nombre);
      //
      // $valor_total = number_format($cotizacion->valor_total_contrato,0);
      // $document->setValue('valor_total_contrato',$valor_total);
      //
      //
      // $document->saveAs('documento/'.$cotizacion->codigo.'.docx');
      //
      // $fichero = 'documento/'.$cotizacion->codigo.'.docx';
      // $nuevo_fichero = 'C:\Users\Ingeniero4.CT\Downloads/'.$cotizacion->codigo.'.docx';
      //
      // if (!copy($fichero, $nuevo_fichero)) {
      //   echo "Error al copiar $fichero...\n";
      // }

    }

    // public function doc($id){
    //   dd($id);
    //   die();
    // }
    // public function doc($id){ // tiene que mandar el id para poder encontrar al que se deba generar
    //
    //   $main = public_path().'/documento'.'/contrato_main.docx';
    //   // $PHPWord = new \PhpOffice\PhpWord\PhpWord();
    //   // if (file_exists(public_path().'/documento'.'/temp_contrato.html')) {
    //   //   unlink(public_path().'/documento'.'/temp_contrato.html');
    //   // }
    //
    //
    //   $document = new TemplateProcessor($main);
    //   $firma = public_path().'/firma.jpg';
    //
    //   $contrato = Administrativa::findOrFail($id);
    //
    //   $muni =  explode(',',$contrato->municipio);
    //   $count = count($muni);
    //   $cadena = '';
    //   for ($x=0; $x < $count ; $x++) {
    //     $array_muni[] =  Municipio::where('municipio.id', '=', $muni[$x])->get();
    //   }
    //   // dd($array_muni);
    //   // die();
    //   if (count($muni) > 1) {
    //     for ($i=0; $i < $count; $i++) {
    //
    //
    //       foreach ($array_muni[$i] as $key => $value) {
    //         $conta = $count- 1;
    //
    //
    //         if ($i == $conta) {
    //
    //           $cadena .= 'y '.$value->nombre;
    //
    //         }else {
    //           $cadena .= $value->nombre.', ';
    //         }
    //
    //       }
    //     }
    //   }else {
    //     for ($i=0; $i < $count; $i++) {
    //
    //       $array_muni[] =  Municipio::where('municipio.id', '=', $muni[$i])->get();
    //       $cadena = '';
    //       foreach ($array_muni[$i] as $key => $value) {
    //
    //         $cadena = $value->nombre;
    //
    //       }
    //     }
    //   }
    //
    //   if ($count > 1) {
    //     $texto = 'LOS MUNICIPIOS DE '.$cadena;
    //   }else {
    //     $texto = 'EL MUNICIPIO DE '.$cadena;
    //   }
    //
    //   $municipio = implode(',',$array_muni);
    //
    //   if (!is_null($contrato->cliente_id)) {
    //     $cliente = Cliente::findOrFail($contrato->cliente_id);
    //   }
    //   if (!is_null($contrato->juridica_id)) {
    //     $juridica = Juridica::findOrFail($contrato->juridica_id);
    //   }
    //
    //
    //   // $cotizacion = Cotizacion::where('cotizacion.cliente_id', '=', $contrato->id_cotizacion)->get();
    //   // $cotizacion = Cotizacion::findOrFail($contrato->id_cotizacion);
    //
    //   $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $contrato->id)->get();
    //   $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $contrato->id)->get();
    //   $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $contrato->id)->get();
    //   $municipio = Municipio::find($contrato->municipio);
    //   $departamento = Departamento::find($contrato->departamento_id);
    //
    //   $table = '';
    //   $table .= '<w:tbl>';
    //     $table .= '<w:tblPr>';
    //     $table .=   '<w:tblBorders>';
    //     $table .=     '<w:top w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=     '<w:start w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=     '<w:bottom w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=     '<w:end w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=     '<w:insideH w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=     '<w:insideV w:val="single" w:sz="8" w:space="0" w:color="000000" />';
    //     $table .=   '<w:tblW w:w="5000" w:type="pct"/>';
    //     $table .=   '</w:tblBorders>';
    //     $table .=  '</w:tblPr>';
    //     $table .=  '<w:tr>';
    //     $table .=    '<w:tc>';
    //     $table .=      '<w:p>';
    //     $table .=        '<w:r>';
    //     $table .=          '<w:rPr>';
    //     $table .=            '<w:b />';
    //     $table .=          '</w:rPr>';
    //     $table .=          '<w:t>INDICE</w:t>';
    //     $table .=        '</w:r>';
    //     $table .=     '</w:p>';
    //     $table .=    '</w:tc>';
    //     $table .=    '<w:tc>';
    //     $table .=      '<w:p>';
    //     $table .=        '<w:r>';
    //     $table .=          '<w:rPr>';
    //     $table .=            '<w:b />';
    //     $table .=          '</w:rPr>';
    //     $table .=          '<w:t>DESCRIPCION</w:t>';
    //     $table .=        '</w:r>';
    //     $table .=     '</w:p>';
    //     $table .=    '</w:tc>';
    //     $table .=    '<w:tc>';
    //     $table .=      '<w:p>';
    //     $table .=        '<w:r>';
    //     $table .=          '<w:rPr>';
    //     $table .=            '<w:b />';
    //     $table .=          '</w:rPr>';
    //     $table .=          '<w:t>CAPACIDAD</w:t>';
    //     $table .=        '</w:r>';
    //     $table .=      '</w:p>';
    //     $table .=    '</w:tc>';
    //     $table .=    '<w:tc>';
    //     $table .=      '<w:p>';
    //     $table .=        '<w:r>';
    //     $table .=          '<w:rPr>';
    //     $table .=            '<w:b />';
    //     $table .=          '</w:rPr>';
    //     $table .=          '<w:t>CANTIDAD</w:t>';
    //     $table .=        '</w:r>';
    //     $table .=      '</w:p>';
    //     $table .=    '</w:tc>';
    //     $table .=  '</w:tr>';
    //
    //     $i = 1;
    //     foreach ($transformaciones as $key => $transfor) {
    //
    //       $table .=   '<w:tblPr>';
    //       $table .=     '<w:tblStyle w:val="TableGrid"/>';
    //       $table .=   '</w:tblPr>';
    //       $table .=  '<w:tr>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$i++.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$transfor->descripcion.' '.$transfor->tipo.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$transfor->unidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$transfor->cantidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=  '</w:tr>';
    //     }
    //     foreach ($distribuciones as $key => $distri) {
    //
    //       $table .=   '<w:tblPr>';
    //       $table .=     '<w:tblStyle w:val="TableGrid"/>';
    //       $table .=     '<w:tblW w:w="0" w:type="auto"/>';
    //       $table .=   '</w:tblPr>';
    //       $table .=  '<w:tr>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$i++.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$distri->descripcion.' '.$distri->tipo.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$distri->unidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$distri->cantidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=  '</w:tr>';
    //     }
    //     foreach ($pu_finales as $key => $pu) {
    //
    //       $table .=   '<w:tblPr>';
    //       $table .=     '<w:tblStyle w:val="TableGrid"/>';
    //       $table .=     '<w:tblW w:w="0" w:type="auto"/>';
    //       $table .=   '</w:tblPr>';
    //       $table .=  '<w:tr>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$i++.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$pu->descripcion.' '.$pu->tipo.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=     '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$pu->unidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=    '<w:tc>';
    //       $table .=      '<w:p>';
    //       $table .=        '<w:r>';
    //       $table .=          '<w:t>'.$pu->cantidad.'</w:t>';
    //       $table .=        '</w:r>';
    //       $table .=      '</w:p>';
    //       $table .=    '</w:tc>';
    //       $table .=  '</w:tr>';
    //     }
    //   $table .= '</w:tbl>';
    //
    //
    //   $document->setValue('codigo',$contrato->codigo_proyecto);
    //
    //   if (!is_null($contrato->cliente_id)) {
    //     $document->setValue('cliente',$cliente->nombre);
    //   }else {
    //     $document->setValue('cliente',$juridica->nombre_representante);
    //   }
    //
    //   if (!is_null($contrato->cliente_id)) {
    //     if (!is_null($cliente->cedula)) {
    //       $document->setValue('marca','C.C:');
    //       $document->setValue('nit',$cliente->cedula);
    //     }else {
    //       $document->setValue('marca','NIT:');
    //       $document->setValue('nit',$cliente->nit);
    //     }
    //   }else {
    //     $document->setValue('marca','NIT:');
    //     $document->setValue('nit',$juridica->nit);
    //   }
    //
    //   $document->setValue('table',$table);
    //   $document->setValue('nombre_proyecto',$contrato->nombre_proyecto);
    //   $document->setValue('municipio',$texto);
    //
    //   if (!is_null($contrato->cliente_id)) {
    //     $document->setValue('nombres',$cliente->nombre);
    //     $document->setValue('cedula',$cliente->cedula);
    //     $document->setValue('representa','Representante Legal');
    //     $document->setValue('empresa','');
    //     $document->setValue('nit_empresa','');
    //
    //   }else {
    //     $document->setValue('nombres',$juridica->nombre_representante);
    //     $document->setValue('cedula',$juridica->cedula);
    //     $document->setValue('representa','Representante Legal');
    //     $document->setValue('empresa',$juridica->razon_social);
    //     $document->setValue('nit_empresa',$juridica->nit);
    //   }
    //
    //
    //   $document->setValue('departamento',$departamento->nombre);
    //   $document->setValue('adicional',$contrato->adicional);
    //   $letras = NumeroALetras::convertir($contrato->valor_total_contrato, 'pesos', 'centavos');
    //
    //   $document->setValue('letras',$letras);
    //   $valor_total = number_format($contrato->valor_total_contrato,0);
    //   $document->setValue('valor_total_contrato',$valor_total);
    //
    //   $document->saveAs('documento/'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx');
    //
    //   // $ficher = 'documento/temp_contrato.docx';
    //   //
    //   // return Response::download('documento/'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx');
    //
    //
    // }

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

    public function editar($id)
    {
      $documento = Documento::find($id);
      return view('documentoscon.edit',compact('documento'));
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
