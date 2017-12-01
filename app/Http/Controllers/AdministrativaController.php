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
use App\Valor_adicional;
use App\Observacion;
use App\Documento;
use App\Cotizacion;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;
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

    public static function dater($x) {
       $year = substr($x, 0, 4);
       $mon = substr($x, 5, 2);
       switch($mon) {
          case "01":
             $month = "Enero";
             break;
          case "02":
             $month = "Febrero";
             break;
          case "03":
             $month = "Marzo";
             break;
          case "04":
             $month = "Abril";
             break;
          case "05":
             $month = "Mayo";
             break;
          case "06":
             $month = "Junio";
             break;
          case "07":
             $month = "Julio";
             break;
          case "08":
             $month = "Agosto";
             break;
          case "09":
             $month = "Septiembre";
             break;
          case "10":
             $month = "Octubre";
             break;
          case "11":
             $month = "Noviembre";
             break;
          case "12":
             $month = "Diciembre";
             break;
       }
       $day = substr($x, 8, 2);
       return $day." de ".$month." de ".$year;
    }
}

class AdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function viewpdf()
    {
      $pdf = PDF::loadView('administrativas.show');
      return $pdf->download('archivo.pdf');

    }
    //  metodo que permite retornar una vista con todos los datos de los registros
    public function index()
    {
      $administrativas = Administrativa::all();
      $clientes = Cliente::all();
      $otrosis = Otrosi::all();
      $distribuciones = Distribucion::all();
      $transformaciones = Transformacion::all();
      $pu_finales = Pu_final::all();
      $cotizaciones = Cotizacion::all();
      return view('administrativas.index',compact('administrativas','otrosis','cotizaciones'));        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  metodo que permite capturar todos los datos de los modelos relacionados para mostrar datos en la vista a manera de "selects"
     public function create(Request $request)
     {
       $input = $request->all();
       $codigo_cot = $request->codigo_cot;

       $clientes=Cliente::all();
       $juridicas = Juridica::all();
       $otrosis=Otrosi::all();
       $departamentos = Departamento::all();
       $cotizaciones = Cotizacion::findOrFail($codigo_cot);

       $municipios = explode(',',$cotizaciones->municipio);
       $count = count($municipios);
       for ($i=0; $i < $count; $i++) {

         $array_muni[] =  Municipio::where('municipio.id', '=', $municipios[$i])->get();
       }

       $transformaciones = Transformacion::where('transformacion.cotizacion_id', '=', $codigo_cot)->get();
      //  $distribuciones = Distribucion::where('distribucion.cotizacion_id', '=', $codigo_cot)->get();
       $pu_finales = Pu_final::where('pu_final.cotizacion_id', '=', $codigo_cot)->get();
       $mts = DB::table('distribucion')->where('cotizacion_id', '=', $codigo_cot)->where('descripcion', 'like', '%MT%')->get();
       $bts = DB::table('distribucion')->where('cotizacion_id', '=', $codigo_cot)->where('descripcion', 'like', '%BT%')->get();

       $datos = Administrativa::count('codigo_proyecto');
       $num = Administrativa::max('codigo_proyecto');

      //  $num = "COT-2017-A-999";
       $numero = explode("-", $num);

       $flag = true;
       $fecha = date("Y");

       if ($datos == 0) {

         $codigo = "CPS-".$fecha."-001";

       }elseif ($numero[2] >= 1) {

         while ($flag) {

           if ($numero[2] < 9) {
             $numero[2] = $numero[2] +1;
             $codigo = $numero[0]."-".$numero[1]."-00".$numero[2];
             $flag = false;

           }elseif ($numero[2] <= 98) {
             $numero[2] = $numero[2] +1;
             $codigo = $numero[0]."-".$numero[1]."-0".$numero[2];

             $flag = false;

           }elseif ($numero[2] < 999) {
             $numero[2] = $numero[2] +1;
             $codigo = $numero[0]."-".$numero[1]."-".$numero[2];

             $flag = false;
           }elseif($numero[2]>=999){
             $numero[2]=0;
             $i++;

           }


         }
       }


       return view('administrativas.create',compact('clientes','otrosis','mts','bts','transformaciones','pu_finales','departamentos','juridicas','cotizaciones','array_muni','codigo'));
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

      // $data = $request->all();

      $input = $request->all($request->id_cotizacion);

      $adicional = Cotizacion::findOrFail($request->id_cotizacion);

      $municipio =  implode(',',$request->municipio);

       //  ********************************************************************************
       //  ********************************************************************************
      //  almacenar en un arreglo $administrativa los datos provenientes desde el formulario de datos basicos
       $administrativa['codigo_proyecto'] = $request->codigo;
       $administrativa['nombre_proyecto'] = ucfirst(mb_strtolower($request->nombre));
       $administrativa['fecha_contrato'] = $request->fecha;
       $administrativa['cliente_id'] = $request->cliente_id;
       $administrativa['juridica_id'] = $request->juridica_id;
       $administrativa['departamento_id'] = $request->departamento;
       $administrativa['municipio'] = $municipio;
       $administrativa['tipo_zona'] = $request->zona;
       $administrativa['valor_contrato_inicial'] = $request->contrato_inicial;
       $administrativa['valor_iva'] = str_replace(',','',$request->iva);
       $administrativa['valor_contrato_final'] =str_replace(',','',$request->contrato_final);
       $administrativa['formas_pago'] = ucfirst(mb_strtolower($request->formas_pago));
       $administrativa['saldo'] =  $administrativa['valor_contrato_final'];
       $administrativa['valor_total_contrato'] =  $administrativa['valor_contrato_final'];
       $administrativa['recordar'] = 1;
       $administrativa['recor_fac'] = 1;
       $administrativa['contador_otro'] = 0;
       $administrativa['contador_fac'] = 0;
       $administrativa['adicional'] = $adicional->adicional;

       $administrativa['id_cotizacion'] = $request->id_cotizacion;



       $codigorepe = Administrativa::where('codigo_proyecto',$request->codigo)->get();
       //  condicional
       if ($codigorepe->count() == 1) {
         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'El código ya está registrado no se puede crear!');
         Session::flash('class', 'danger');

        //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }
       else{
         //  funsion que permite actualizar los datos de un registro almacenado en la variable $input
         Administrativa::create($administrativa);
         $admins = Administrativa::all();
         $lastId_admin = $admins->last()->id;//funcion que consigue capturar el ultimo registro y sacar el id de este mismo

         $registro = Administrativa::findOrFail($lastId_admin);
        //  $registro->saldo = $registro->valor_contrato_final - $registro->pagado;
        if ($request->transformacion == "transformacion") {

        }else {
          if (isset($input['transformacion']['descripcion'])) {
            for ($i=0; $i < count($input['transformacion']['id']) ; $i++) {

              $transforma = Transformacion::findOrFail($input['transformacion']['id'][$i]);
              $transforma->administrativa_id = $lastId_admin;
              $transforma->save();
            }
          }

        }
        if ($request->distribucion == "distribucion") {

        }else {
          if (isset($input['distribucion']['descripcion_dis'])) {
            for ($i=0; $i < count($input['distribucion']['id_dis']) ; $i++) {

              $distri = Distribucion::findOrFail($input['distribucion']['id_dis'][$i]);
              $distri->administrativa_id = $lastId_admin;
              $distri->save();
            }
          }else {
            # code...
          }

        }
        if ($request->pu_final == "pu_final") {

        }else {
          if (isset($input['pu_final']['descripcion_pu'])) {
            for ($i=0; $i < count($input['pu_final']['id_pu']) ; $i++) {

              $pu= Pu_final::findOrFail($input['pu_final']['id_pu'][$i]);
              $pu->administrativa_id = $lastId_admin;
              $pu->save();
            }
          }

        }

         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'Contrato creado!');
         Session::flash('class', 'success');
       }

      //  funcion para traer todos los registros de administrativa
       $admin = Administrativa::all();

      //  funcion para traer el ultimo registro de administrativa
       $lastId_admin = $admin->last()->id;

       $obs['observacion'] = ucfirst(mb_strtolower($request->observacion));
       $obs['administrativa_id'] = $lastId_admin;


       Observacion::create($obs);
      //  codigo para insertar los otrosi que vienen desde un arreglo y recorrerlo para hacer el create

        // for ($a=0; $a<count($input['transformacion']['descripcion']); $a++){
        //
        //       if (!empty($input['transformacion']['descripcion'][$a]) &&
        //           !empty($input['transformacion']['tipo'][$a]) &&
        //           !empty($input['transformacion']['capacidad'][$a]) &&
        //           !empty($input['transformacion']['unidad_transformacion'][$a]) &&
        //           !empty($input['transformacion']['cantidad'][$a])) {
        //
        //             $datos1['descripcion'] = $input['transformacion']['descripcion'][$a];
        //             $datos1['tipo'] = $input['transformacion']['tipo'][$a];
        //             $datos1['capacidad'] = $input['transformacion']['capacidad'][$a];
        //             $datos1['unidad'] = $input['transformacion']['unidad_transformacion'][$a];
        //             $datos1['cantidad'] = $input['transformacion']['cantidad'][$a];
        //             $datos1['administrativa_id'] = $lastId_admin;
        //
        //             Transformacion::create($datos1);
        //       }
        // }
        //
        // for ($x=0; $x<count($input['distribucion']['descripcion_dis']); $x++) {
        //     if (!empty($input['distribucion']['descripcion_dis'][$x]) &&
        //         !empty($input['distribucion']['tipo_dis'][$x]) &&
        //         !empty($input['distribucion']['unidad_distribucion'][$x]) &&
        //         !empty($input['distribucion']['cantidad_dis'][$x])){
        //
        //           $datos2['descripcion'] = $input['distribucion']['descripcion_dis'][$x];
        //           $datos2['tipo'] = $input['distribucion']['tipo_dis'][$x];
        //           $datos2['unidad'] = $input['distribucion']['unidad_distribucion'][$x];
        //           $datos2['cantidad'] = str_replace('.',',',$input['distribucion']['cantidad_dis'][$x]);
        //
        //           $datos2['administrativa_id'] = $lastId_admin;
        //
        //           Distribucion::create($datos2);
        //     }
        // }
        //
        // for ($i=0; $i<count($input['pu_final']['descripcion_pu']); $i++) {
        //     if (!empty($input['pu_final']['descripcion_pu'][$i]) &&
        //         !empty($input['pu_final']['tipo_pu'][$i]) &&
        //         !empty($input['pu_final']['unidad_pu_final'][$i]) &&
        //         !empty($input['pu_final']['cantidad_pu'][$i])) {
        //
        //           $datos3['descripcion'] = $input['pu_final']['descripcion_pu'][$i];
        //           $datos3['tipo'] = $input['pu_final']['tipo_pu'][$i];
        //           $datos3['unidad'] = $input['pu_final']['unidad_pu_final'][$i];
        //           $datos3['cantidad'] = $input['pu_final']['cantidad_pu'][$i];
        //           $datos3['administrativa_id'] = $lastId_admin;
        //
        //           Pu_final::create($datos3);
        //     }
        // }
        // dd($datos4);
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
     $dir = opendir('documento/');

       while($f = readdir($dir))
       {

         if((time()-filemtime('documento/'.$f) > 3600*24*7) and !(is_dir('documento/'.$f)))
         unlink('documento/'.$f);
       }
     closedir($dir);
      $this->doc($id);
      //  funcion que permite acceder al modelo y este a su ves ir a la base de datos y encontrar un registro
      $administrativa = Administrativa::find($id);

       $muni_Id = Municipio::select('id')->where('id',$administrativa->municipio)->get();
       $municipio = Municipio::find($muni_Id);

       $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
       $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
       $observaciones = Observacion::where('observacion.administrativa_id', '=', $id)->get();
      //  dd($observaciones);
      //  die();
       $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
       $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
       $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
       $consignaciones = Consignacion::where('consignacion.administrativa_id', '=', $id)->get();
       $cuenta_cobros = Cuenta_cobro::where('cuenta_cobro.administrativa_id', '=', $id)->get();
       $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();
       $juridicas = Juridica::select('razon_social')->where('id',$administrativa->juridica_id)->get();



      //  funcion que permite retornar una vista con los datos ya buscados
       return view('administrativas.show',compact('administrativa','municipio','otrosis','transformaciones','distribuciones','pu_finales','consignaciones','cuenta_cobros','facturas','adicionales','juridicas','observaciones'));
   }

   public function doc($id){ // tiene que mandar el id para poder encontrar al que se deba generar

     $main = public_path().'/plantillas/contrato_main.docx';
     $contrato = Administrativa::findOrFail($id);

    //  $total_archivos = count(glob('carpeta/{*.docx}',GLOB_BRACE));
     // $PHPWord = new \PhpOffice\PhpWord\PhpWord();
     if (file_exists(public_path().'/documento'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx')) { //funcion que nos permite borrar un archivo si ya esta creado anteriormente
       unlink(public_path().'/documento'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx');
     }




     $document = new TemplateProcessor($main);
     $firma = public_path().'/firma.jpg';


     $muni =  explode(',',$contrato->municipio);
     $count = count($muni);
     $cadena = '';
     for ($x=0; $x < $count ; $x++) {
       $array_muni[] =  Municipio::where('municipio.id', '=', $muni[$x])->get();
     }
     // dd($array_muni);
     // die();
     if (count($muni) > 1) {
       for ($i=0; $i < $count; $i++) {


         foreach ($array_muni[$i] as $key => $value) {
           $conta = $count- 1;


           if ($i == $conta) {

             $cadena .= 'y '.$value->nombre;

           }else {
             $cadena .= $value->nombre.', ';
           }

         }
       }
     }else {
       for ($i=0; $i < $count; $i++) {

         $array_muni[] =  Municipio::where('municipio.id', '=', $muni[$i])->get();
         $cadena = '';
         foreach ($array_muni[$i] as $key => $value) {

           $cadena = $value->nombre;

         }
       }
     }

     if ($count > 1) {
       $texto = 'LOS MUNICIPIOS DE '.$cadena;
     }else {
       $texto = 'EL MUNICIPIO DE '.$cadena;
     }

     $municipio = implode(',',$array_muni);

     if (!is_null($contrato->cliente_id)) {
       $cliente = Cliente::findOrFail($contrato->cliente_id);
     }
     if (!is_null($contrato->juridica_id)) {
       $juridica = Juridica::findOrFail($contrato->juridica_id);
     }


     // $cotizacion = Cotizacion::where('cotizacion.cliente_id', '=', $contrato->id_cotizacion)->get();
     // $cotizacion = Cotizacion::findOrFail($contrato->id_cotizacion);

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
       $table .=        '<w:pPr>';
       $table .=           '<w:jc w:val="center"/>';
       $table .=        '</w:pPr>';
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
       $table .=        '<w:pPr>';
       $table .=           '<w:jc w:val="center"/>';
       $table .=        '</w:pPr>';
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
       $table .=        '<w:pPr>';
       $table .=           '<w:jc w:val="center"/>';
       $table .=        '</w:pPr>';
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
       $table .=        '<w:pPr>';
       $table .=           '<w:jc w:val="center"/>';
       $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
         $table .=        '<w:r>';
         $table .=          '<w:t>'.$transfor->unidad.'</w:t>';
         $table .=        '</w:r>';
         $table .=      '</w:p>';
         $table .=    '</w:tc>';
         $table .=    '<w:tc>';
         $table .=      '<w:p>';
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
         $table .=        '<w:r>';
         $table .=          '<w:t>'.$distri->unidad.'</w:t>';
         $table .=        '</w:r>';
         $table .=      '</w:p>';
         $table .=    '</w:tc>';
         $table .=    '<w:tc>';
         $table .=      '<w:p>';
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
         $table .=        '<w:r>';
         $table .=          '<w:t>'.$pu->unidad.'</w:t>';
         $table .=        '</w:r>';
         $table .=      '</w:p>';
         $table .=    '</w:tc>';
         $table .=    '<w:tc>';
         $table .=      '<w:p>';
         $table .=        '<w:pPr>';
         $table .=           '<w:jc w:val="center"/>';
         $table .=        '</w:pPr>';
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
       $document->setValue('cliente',mb_strtoupper($cliente->nombre));
     }else {
       $document->setValue('cliente',mb_strtoupper($juridica->nombre_representante));
     }

     if (!is_null($contrato->cliente_id)) {
       if (!is_null($cliente->cedula)) {
         $document->setValue('marca','C.C.');
         $document->setValue('nit',$cliente->cedula);
       }else {
         $document->setValue('marca','NIT:');
         $document->setValue('nit',$cliente->nit,0);
       }
     }else {
       $document->setValue('marca','NIT:');
       $document->setValue('nit',$juridica->nit,0);
     }

     $document->setValue('tabla',$table);
     $document->setValue('nombre_proyecto',mb_strtoupper($contrato->nombre_proyecto));
     $document->setValue('municipio',str_replace("Ñ", "ñ", mb_strtoupper($texto,'UTF-8')));

     if (!is_null($contrato->cliente_id)) {
       $document->setValue('nombres',mb_strtoupper($cliente->nombre));
       $document->setValue('cedula',$cliente->cedula);
       $document->setValue('representa','');
       $document->setValue('empresa','');
       $document->setValue('nit_empresa','');

     }else {
       $document->setValue('nombres',mb_strtoupper($juridica->nombre_representante));
       $document->setValue('cedula',$juridica->cedula);
       $document->setValue('representa','Representante Legal');
       $document->setValue('empresa',$juridica->razon_social);
       $document->setValue('nit_empresa',$juridica->nit);
     }


     $document->setValue('departamento',mb_strtoupper($departamento->nombre)); 
     $document->setValue('adicional',$contrato->adicional);
     $letras = NumeroALetras::convertir($contrato->valor_total_contrato, 'pesos', 'centavos');

     $document->setValue('letras',$letras);
     $valor_total = number_format($contrato->valor_total_contrato,0);
     $document->setValue('valor_total_contrato',$valor_total);
     $document->setValue('fecha',NumeroALetras::dater($contrato->fecha_contrato));
     $document->saveAs('documento/'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx');

     // $ficher = 'documento/temp_contrato.docx';
     //
     // return Response::download('documento/'.$contrato->codigo_proyecto.'-'.$contrato->nombre_proyecto.'.docx');

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
      $administrativas = Administrativa::find($id);



      // $admin  = $administrativas->id;
      $departamentos = Departamento::all();
      $clientes =Cliente::all();
      $juridicas = Juridica::all();

      $municipios = explode(',',$administrativas->municipio);
      $count = count($municipios);
      for ($i=0; $i < $count; $i++) {

        $array_muni[] =  Municipio::where('municipio.id', '=', $municipios[$i])->get();
      }

      $adicionales = Valor_adicional::where('valor_adicional.administrativa_id', '=', $id)->get();
      $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
      $transformaciones = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();
      $distribuciones = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
      $mts = DB::table('distribucion')->where('administrativa_id', '=', $id)->where('descripcion', 'like', '%MT%')->get();
      $bts = DB::table('distribucion')->where('administrativa_id', '=', $id)->where('descripcion', 'like', '%BT%')->get();

      $pu_finales = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
      $consignaciones = Consignacion::where('consignacion.administrativa_id', '=', $id)->get();
      $cuenta_cobros = Cuenta_cobro::where('cuenta_cobro.administrativa_id', '=', $id)->get();
      $facturas = Factura::where('factura.administrativa_id', '=', $id)->get();
      $observaciones = Observacion::where('observacion.administrativa_id', '=', $id)->get();


      //  funcion que retorna una vista con todos los datos del registro ya buscado
       return view('administrativas.edit',compact('administrativas','clientes','juridicas','otrosis','mts','bts','distribuciones','transformaciones','pu_finales','departamentos','array_muni','adicionales','facturas','cuenta_cobros','consignaciones','observaciones'));
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
       $input = $request->all();
      //  dd($input);
      //  die();
       $depart = $request->departamento;
       $administrativas = Administrativa::findOrFail($id);
       $facturas = Factura::where('factura.administrativa_id', '=', $administrativas->id)->get();

       $municipio = implode(',',$request->municipio);


       $administrativa['codigo_proyecto'] = $request->codigo_proyecto;
       $administrativa['nombre_proyecto'] = ucfirst(mb_strtolower($request->nombre_proyecto));
       $administrativa['fecha_contrato'] = $request->fecha_contrato;
      //  $administrativa['cliente_id'] = $request->cliente_id;
      //  $administrativa['juridica_id'] = $request->juridica_id;
       $administrativa['departamento_id'] = $request->departamento_id;
       $administrativa['municipio'] = $request->municipio;
       $administrativa['tipo_zona'] = $request->zona;
       $administrativa['valor_contrato_inicial'] = $request->valor_contrato_inicial;
       $administrativa['valor_iva'] = str_replace(',','',$request->iva);
       $administrativa['valor_contrato_final'] =str_replace(',','',$request->contrato_final);
       $administrativa['formas_pago'] = ucfirst(mb_strtolower($request->formas_pago));


       if ($request->tipo_regimen == 1) {

         $administrativa['cliente_id'] = $request->cliente_id;
         $administrativas->juridica_id = null;
         $administrativas->save();

       }else {

         $administrativa['juridica_id'] = $request->juridica_id;
         $administrativas->cliente_id = null;
         $administrativas->save();

       }

       if (str_replace(',','',$administrativas->valor_contrato_final) == $administrativa['valor_contrato_final']) {

         $administrativa2['codigo_proyecto'] = $request->codigo_proyecto;
         $administrativa2['nombre_proyecto'] = ucfirst(mb_strtolower($request->nombre_proyecto));
         $administrativa2['fecha_contrato'] = $request->fecha_contrato;
        //  $administrativa['cliente_id'] = $request->cliente_id;
        //  $administrativa['juridica_id'] = $request->juridica_id;
         $administrativa2['departamento_id'] = $request->departamento_id;
         $administrativa2['municipio'] = $municipio;
         $administrativa2['tipo_zona'] = $request->zona;
         $administrativa2['valor_contrato_inicial'] = $request->valor_contrato_inicial;
         $administrativa2['valor_iva'] = str_replace(',','',$request->iva);
         $administrativa2['formas_pago'] = ucfirst(mb_strtolower($request->formas_pago));

         if ($request->tipo_regimen == 1) {

           $administrativa2['cliente_id'] = $request->cliente_id;
           $administrativas->juridica_id = null;
           $administrativas->save();

         }else {

           $administrativa2['juridica_id'] = $request->juridica_id;
           $administrativas->cliente_id = null;
           $administrativas->save();

         }

         $administrativas->update($administrativa2);

         //  mensajes de confirmacion enviados a la vista
         Session::flash('message', 'Contrato editado!');
         Session::flash('class', 'success');

         //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');

       }

       if ($administrativas->saldo == 0 && $administrativa['valor_contrato_final'] < str_replace(',','',$administrativas->valor_contrato_final)) {
         Session::flash('message', 'El valor es menor al saldo por favor verifique los pagos!');
         Session::flash('class', 'danger');

        //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }
       if (count($facturas) > 0) {
         Session::flash('message', 'No se puede editar el valor debido a que existen pagos!');
         Session::flash('class', 'danger');

        //  redireccionamiento a una vista
         return redirect()->route('administrativas.index');
       }

       if ($administrativas->saldo >= str_replace(',','',$administrativas->valor_contrato_final)) {

          $anexo = $administrativas->saldo - str_replace(',','',$administrativas->valor_contrato_final);
          $suma = $administrativa['valor_contrato_final'] + $anexo;
          $administrativa['saldo'] = $suma;

       }else {

         $anexo = str_replace(',','',$administrativas->valor_contrato_final) - $administrativas->saldo;
         $suma = $administrativa['valor_contrato_final'] + $anexo;
         $administrativa['saldo'] = $suma;

       }


       if ($administrativas->valor_total_contrato >= str_replace(',','',$administrativas->valor_contrato_final)) {

         $anexo = $administrativas->valor_total_contrato - str_replace(',','',$administrativas->valor_contrato_final);
         $suma = $administrativa['valor_contrato_final'] + $anexo;
         $administrativa['valor_total_contrato'] = $suma;


       }else {

         $anexo = str_replace(',','',$administrativas->valor_contrato_final) - $administrativas->valor_total_contrato;
         $suma = $administrativa['valor_contrato_final'] + $anexo;
         $administrativa['valor_total_contrato'] = $suma;

       }




       //  condicional que permite saber si el codigo de proyecto que se envio es igual a uno ya exitente cumpla con la condicion de no permitir actualizar el codigo por uno ya existent
       $codigorepe = Administrativa::where('codigo_proyecto',$request->codigo)->get();
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

         $administrativas->update($administrativa);

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

     $administrativa = Administrativa::findOrFail($id);

     $transfor = Transformacion::where('transformacion.administrativa_id', '=', $id)->get();

     foreach ($transfor as $key => $trans) {

       $registro = Transformacion::findOrFail($trans->id);

       if ($registro->cotizacion_id == null) {
         $registro->delete();
       }else {
         $registro->administrativa_id = null;
         $registro->save();
       }

     }

     $distribucion = Distribucion::where('distribucion.administrativa_id', '=', $id)->get();
     foreach ($distribucion as $key => $distri) {

       $registro = Distribucion::findOrFail($distri->id);

       if ($registro->cotizacion_id == null) {
         $registro->delete();
       }else {
         $registro->administrativa_id = null;
         $registro->save();
       }

     }

     $pu_final = Pu_final::where('pu_final.administrativa_id', '=', $id)->get();
     foreach ($pu_final as $key => $pu) {

       $registro = Pu_final::findOrFail($pu->id);

       if ($registro->cotizacion_id == null) {
         $registro->delete();
       }else {
         $registro->administrativa_id = null;
         $registro->save();
       }

     }

     // $administrativas = Administrativa::select('id')->where('administrativa.id',$id)->get();
     $administrativa->delete();
      //  //  funcion que permite encontrar o identificar un registro y almacenarlas en una variable


      // dd($id);
      // die();
       //  redireccionamiento a una vista
     Session::flash('message', 'Proyecto eliminado');
     Session::flash('class', 'danger');
     return redirect('administrativas');


   }

}
