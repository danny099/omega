<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\Cotizacion;
use App\Transformacion;
use Session;

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

    public function doc(){ // tiene que mandar el id para poder encontrar al que se deba generar

      $cotizacion = Cotizacion::findOrFail(240);
      $archivo = public_path().'/documentos'.'/dirigido.docx';
      $datos = file_get_contents($archivo);
      $transformaciones = Transformacion::all();
      $tabla1 = '<table class="table table-bordered table-striped" border="1">
                  <tr>
                    <th colspan="6" class="ttable">ALCANCE DE TRANSFORMACIÓN</th>
                  </tr>
                  <tr>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Nivel de Tensión (KV)</th>
                    <th>Capacidad (KVA)</th>
                    <th>Cantidad</th>
                    <th>Tipo de Refrigeración</th>
                  </tr>
                  <tr>';
                  foreach ($transformaciones as $key => $transfor) {
                    "<tr>".
                      "<td>" .$transfor->descripcion. "</td>".
                      "<td>" .$transfor->tipo. "</td>".
                      "<td>" .$transfor->nivel_tension. "</td>".
                      "<td>" .$transfor->capacidad. " KVA</td>".
                      "<td>" .$transfor->cantidad. " Und</td>".
                      "<td>" .$transfor->tipo_refrigeracion. "</td>".
                    "</tr>".
                  }.
                  $tabla1.='</tr>
                </table>';
      echo $tabla1;
      die();
      $datos = str_replace('#dirigido#',$cotizacion->dirigido,$datos);
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



      $file = fopen($archivo,'w');
      fputs($file,$datos);
      fclose($file);
      // echo fputs($file,$cadena);
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
