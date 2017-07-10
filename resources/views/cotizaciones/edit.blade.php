@extends('index')
<style media="screen">
  .separar{
    height: 80px;
  }
  select{
    font-size: 15px;
  }
  ul{
    margin: 20px;
  }
  textarea{
    width:95%;
    resize: none;
  }

</style>
<link rel="stylesheet" href=" {{ url('bootstrap/css/jquery.steps.css')}}">
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li><a href="{{ url('cotizaciones') }}">Cotización</a></li>
  <li class="active">Editar cotización</li>
</ol>

  <div class="box box-primary" >
    <div class="box-header with-border">
      <center> <h3>Cotización</h3> <h3>{{ $cotizaciones->codigo }}</h3> </center>
    </div>
    @if(Session::has('message'))
      <div id="alert">
        <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
        <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{Session::get('message')}}
        </div>
      </div>
    @endif
  <!-- /.box-header -->
  <!-- form start -->

    {!! Form::model($cotizaciones, ['id'=>'form','method' => 'PATCH', 'action' => ['CotizacionController@update',$cotizaciones->id]]) !!}
    {{ csrf_field() }}

    <div class="">


    <h3>Paso 1</h3>
    <section>
    <div class="">
      <center> <h3>Datos</h3> </center>

      <div class="col-md-12">
        <div class="col-md-3">
          <input type="hidden" name="codigo" value="{{ $cotizaciones->codigo }}">
          <input type="hidden"  name="id" value="{{ $cotizaciones->id }}"  >
          <label>Dirigido a :</label>
          <select name="dirigido" style="width:100%" >
            <option value="{{ $cotizaciones->dirigido}}">{{ $cotizaciones->dirigido}}</option>
            <option value="Señor">Señor</option>
            <option value="Señora">Señora</option>
            <option value="Señores">Señores</option>
            <option value="Ingeniero">Ingeniero</option>
            <option value="Ingeniera">Ingeniera</option>
            <option value="Arquitecto">Arquitecto</option>
            <option value="Arquitecta">Arquitecta</option>
          </select>
        </div>
        @if(empty($cotizaciones->juridica->id ))
        <div class="col-md-3">
          <label>Tipo de régimen</label>
          <select class="" name="tipo_regimen" id="cliente" style="width: 100%" required="">
            <option value="1">Persona natural</option>
            <option value="2">Persona jurídica</option>
          </select>
        </div>
        <div class="col-md-3"  id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%;" id="select-natural">
            <option value="{{ $cotizaciones->cliente->id }}">{{ $cotizaciones->cliente->nombre }}</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3" style="Display:none" id="juridica">
          <label >Persona jurídica </label>
          <select class="form-control" name="juridica_id" style="width: 100%;" >
            <option value="">Seleccione</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
        @endif
        @if(empty($cotizaciones->cliente->id ))
        <div class="col-md-3">
          <label>Tipo de régimen</label>
          <select class="" name="tipo_regimen" id="cliente" style="width: 100%" required="">
            <option value="2">Persona jurídica</option>
            <option value="1">Persona natural</option>
          </select>
        </div>
        <div class="col-md-3" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" style="Display:none;width: 100%;" name="cliente_id" id="select-natural">
            <option value="">Seleccione</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3"  id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" style="width: 100%;" >
            <option value="{{ $cotizaciones->juridica->id }}">{{ $cotizaciones->juridica->razon_social }}</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
        @endif
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Nombre del proyecto:</label>
          <input type="text" class="form-control" value="{{ $cotizaciones->nombre}}" name="nombre" required="Ingrese nombre del proyecto">
        </div>
        <div class="col-md-3">
          <label>Departamento</label>

          <select class="form-control" required="" style="width:100%" name="departamento_id" id="departamento">
            <option value="{{ $cotizaciones->departamento->id }}">{{ $cotizaciones->departamento->nombre }}</option>
            @foreach($departamentos as $departamento)
            <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3"id="natural">
          <label >Municipio</label>
          <select class="form-control" required="" style="width:100%" name="municipio" id="municipio">
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
            <option value=""></option>
          </select>
        </div>
      </div>



      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <center> <h3>Detalle de la cotización</h3> </center>
        <div class="col-md-3">
          <label>Formas de pago :</label>
          <select name="formas_pago" style="width:100%" required>
            <option value="{{ $cotizaciones->formas_pago }}">{{ $cotizaciones->formas_pago }}</option>
            <option value="Anticipo 100%">Anticipo 100%</option>
            <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
            <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
            <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
            <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>Tiempo de ejecución</label>
          <input type="text"  class="form-control" name="tiempo" value="{{$cotizaciones->tiempo}}">
        </div>
        <div class="col-md-3">
          <label>Tiempo de entrega de dictámenes</label>
          <input type="text"  class="form-control" name="entrega" value="{{$cotizaciones->entrega}}">
        </div>
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Número  de visitas contratadas</label>
          <input type="text"  class="form-control" name="visitas" value="{{$cotizaciones->visitas}}">
        </div>
        <div class="col-md-3">
          <label>Validez de la oferta</label>
          <input type="text" class="form-control" name="validez" value="{{$cotizaciones->validez}}">
        </div>
      </div>

    </div>
  </section>
    <h3>Paso 2</h3>
      <section>
    <div class="box-body" style="width: 110%">
      @if(count($mts) == 0)
        <input type="hidden"  name="distribucion" value="distribucion"  >
      @else
      <center> <h3>Alcance: proceso de distribución en MT</h3> </center>

        @foreach($mts as $mt)
          <div class="row quitar51" id="quitar51" >
            <div class="col-md-12"  style="margin-bottom: 10px;">
            </div>
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden"  name="distribucion[id][]" value="{{$mt->id}}"  >
                  <center class="separar"><label >Descripción</label></center>
                  <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en MT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <center class="separar"><label >Tipo</label></center>
                  <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                    <option value="{{ $mt->tipo }}">{{ $mt->tipo }}</option>
                    <option value="Aérea">Tipo Aérea</option>
                    <option value="Subterránea">Tipo subterránea</option>
                  </select>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Nivel de tensión (KV) </label></center>
                  <select class="form-control tipo2 tension" name="distribucion[nivel_tension_dis][]" style="width:100%" id="kv">
                    <option value="{{ $mt->nivel_tension }}">{{ $mt->nivel_tension }}</option>
                    <option value="13,2">13,2</option>
                    <option value="13,4">13,4</option>
                    <option value="13,8">13,8</option>
                    <option value="No aplica">No aplica</option>
                  </select>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Longitud de red (mts.)</label></center>
                  <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="{{ $mt->cantidad }}" name="distribucion[cantidad_dis][]">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Apoyos o estructuras</label></center>
                  <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" value="{{ $mt->apoyos }}" name="distribucion[apoyos_dis][]">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Cajas de inspección</label></center>
                  <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" value="{{ $mt->cajas }}" name="distribucion[cajas_dis][]">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <center class="separar"><label >Notas</label></center>
                  <input type="text" class="form-control" placeholder= "Notas" value="{{ $mt->notas }}" name="distribucion[notas_dis][]">
                </div>
              </div>

          </div>

        </div>
        @endforeach
      @endif

      @if(count($transformaciones) == 0)
        <input type="hidden"  name="transformacion" value="transformacion"  >
      @else
      <center> <h3>Alcance: proceso de transformación</h3> </center>

      @foreach($transformaciones as $transfor)
          <div class="row quitar50" id="quitar50">
            <input type="hidden" id="nivel" name="valor" value="{{$transfor->nivel_tension}}">
          <div class="col-md-12">
            <div class="col-md-3">
              <input type="hidden"  name="transformacion[id][]" value="{{$transfor->id}}"  >
              <div class="form-group">
                <center class="separar"><label >Descripción</label></center>
                <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Tipo</label></center>
                <select class="form-control tipo" name="transformacion[tipo][]" style="width:100%">
                  <option value="{{ $transfor->tipo }}">{{ $transfor->tipo }}</option>
                  <option value="Tipo poste">Tipo poste</option>
                  <option value="Tipo interior">Tipo interior</option>
                  <option value="Tipo pedestal/jardin">Tipo pedestal/jardin</option>
                  <option value="Tipo patio">Tipo Patio</option>
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Nivel de tensión (KV)  </label></center>
                <select class="form-control tipo tension2" name="transformacion[nivel_tension][]" style="width:100%" id="kv">
                  <option value="{{ $transfor->nivel_tension }}">{{ $transfor->nivel_tension }}</option>
                  <option value="13,2">13,2</option>
                  <option value="13,4">13,4</option>
                  <option value="13,8">13,8</option>
                  <option value="No aplica">No aplica</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Capacidad (KVA)</label></center>
                  <input type="text" class="form-control capacidad" placeholder="Capacidad"   value="{{$transfor->capacidad}}" name="transformacion[capacidad][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cantidad</label></center>
                <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" value="{{$transfor->cantidad}}"  name="transformacion[cantidad][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Refrigeración </label></center>
                <select class="form-control" name="transformacion[tipo_refrigeracion][]" style="width:100%">
                  <option value="{{ $transfor->tipo_refrigeracion }}">{{ $transfor->tipo_refrigeracion }}</option>
                  <option value="Seco">Seco</option>
                  <option value="Aceite">Aceite</option>
                </select>
              </div>
            </div>

        </div>
      </div>
      @endforeach
    @endif
    @if(count($bts) == 0)
      <input type="hidden"  name="distribucion" value="distribucion"  >
    @else
    <center> <h3>Alcance: proceso de distribución en BT</h3> </center>

      @foreach($bts as $bt)
        <div class="row quitar51" id="quitar51" >
          <div class="col-md-12"  style="margin-bottom: 10px;">
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden"  name="distribucion[id][]" value="{{$bt->id}}"  >
                <center class="separar"><label >Descripción</label></center>
                <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en BT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Tipo</label></center>
                <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                  <option value="{{ $bt->tipo }}">{{ $bt->tipo }}</option>
                  <option value="Aérea">Tipo Aérea</option>
                  <option value="Subterránea">Tipo subterránea</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Nivel de tensión (KV) </label></center>
                <select class="form-control tipo2" name="distribucion[nivel_tension_dis][]" style="width:100%" id="tension">
                  <option value="{{ $bt->nivel_tension }}">{{ $bt->nivel_tension }}</option>
                  <option value="110-220">110-220</option>
                  <option value="220-240">220-240</option>
                  <option value="No aplica">No aplica</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Longitud de red (mts.)</label></center>
                <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="{{ $bt->cantidad }}" name="distribucion[cantidad_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Apoyos o estructuras</label></center>
                <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" value="{{ $bt->apoyos }}" name="distribucion[apoyos_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cajas de inspección</label></center>
                <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" value="{{ $bt->cajas }}" name="distribucion[cajas_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Notas</label></center>
                <input type="text" class="form-control" placeholder= "Notas" value="{{ $bt->notas }}" name="distribucion[notas_dis][]">
              </div>
            </div>
            </div>


      </div>
      @endforeach
    @endif
    @if(count($pu_finales) == 0)
      <input type="hidden"  name="pu_final" value="pu_final"  >
    @else
    <center> <h3>Alcance: proceso de uso final</h3> </center>

      @foreach($pu_finales as $pu)
        <div class="row quitar52" id="quitar52">
          <div class="col-md-12">
          </div>
          <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <input type="hidden"  name="pu[id][]" value="{{$pu->id}}" >
              <center><label >Descripción</label></center>
              <select class="form-control desc3"name="pu_final[descripcion_pu][]" style="width:100%" id="instalacion">
                <option value="{{ $pu->descripcion }}">{{ $pu->descripcion }}</option>
                <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
                <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
                <option value="Inspección RETIE proceso uso final industrial">Inspección RETIE proceso uso final industrial</option>
              </select>
            </div>
          </div>
          @if( $pu->estrato == null)
          <div class="col-md-2 " id="torres">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">
                <option value="{{ $pu->tipo }}">{{ $pu->tipo }}</option>

              </select>
            </div>
          </div>
          @else
          <div class="col-md-2 " id="torre">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">
                <option value="{{ $pu->tipo }}">{{ $pu->tipo }}</option>

              </select>
            </div>
          </div>
          @endif

          @if( $pu->torres == null)
          @else
          <div class="col-md-1 " id="borrar">
            <div class="form-group">
              <center><label >#Torres</label></center>
              <input type="text" class="form-control torre" value="{{$pu->torres}}" placeholder= "Cantidad" name="pu_final[torres][]">
            </div>
          </div>
          @endif
          @if( $pu->estrato == null)
          @else
          <div class="col-md-2" id="estrato">
            <div class="form-group">
              <center><label >Estrato</label></center>
              <select class="form-control"name="pu_final[estrato_pu][]" style="width:100%">
                <option value="{{ $pu->estrato }}">{{ $pu->estrato }}</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
          @endif
          <div class="col-md-1">
            <div class="form-group">
              <center><label >Cantidad</label></center>
              <input type="text" class="form-control cantidad3" value="{{ $pu->cantidad }}" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <center><label >m²</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" value="{{ $pu->metros }}" name="pu_final[metros_pu][]">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <center><label >KVA</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" value="{{ $pu->kva }}" name="pu_final[kva_pu][]">
            </div>
          </div>

        </div>
        </div>
        @endforeach
      @endif
      <div class="col-md-12">
        <center> <h3>Observaciones</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" >{{ $cotizaciones->observaciones}}</textarea>
      </div>
    </div>


</section>
  <h3>Paso 3</h3>
    <section>

     <table class="table table-bordered tabla">
       <tr>
         <th Colspan="5"><center><label> Cotización</label></center></th>
       </tr>
       <tr>
         <th><center><label> Item</label></center></th>
         <th><center><label> Descripcion del alcance</label></center></th>
         <th><center><label> Cantidad</label></center></th>
         <th><center><label> Valor unitario</label></center></th>
         <th><center><label> Valor</label></center></th>
         <th><center><label> <button type="button" class="btn btn-primary generar" style="background-color: #33579A; border-color:#33579A;" name="button">Generar tabla para precios</button></label></center></th>
       </tr>
       <input type="hidden"  value="{{ $datos1 }}" class="datos1">
       <input type="hidden"  value="{{ $datos2 }}" class="datos2">
       <input type="hidden"  value="{{ $datos3 }}" class="datos3">

     </table>
   </section>
   </div>
   {!! Form::close() !!}


  </div>

@endsection



@section('scripts')


<script type="text/javascript">
var validar = 0;
function mascara(o,f){
  v_obj=o;
  v_fun=f;
  setTimeout("execmascara()",1);
}
function execmascara(){
  v_obj.value=v_fun(v_obj.value);
}
function cpf(v){
  v=v.replace(/([^0-9\.]+)/g,'');
  v=v.replace(/^[\.]/,'');
  v=v.replace(/[\.][\.]/g,'');
  v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2');
  v=v.replace(/\.(\d{1,2})\./g,'.$1');
  v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');
  v = v.split('').reverse().join('').replace(/^[\,]/,'');
  return v;
}
function addCommas(nStr){
  nStr += '';
  x = nStr.split(',');
  x1 = x[0];
  x2 = x.length > 1 ? ',' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}

$(function() {
    var count = 1;

   $(".generar").on("click",function( event ) {
      count++;
      validar = 1;
      var x= $().val();
      var valor_multi = 0;
      var valor_multi_dis = 0;
      var valor_multi_pu = 0;
      var operador1=0;
      var acumu1=0;
      var operador2=0;
      var acumu2=0;
      var operador3=0;
      var acumu3=0;
      var datos = JSON.parse($(".datos1").val())
      var datos2 = JSON.parse($(".datos2").val())
      var datos3 = JSON.parse($(".datos3").val())
      $.each(datos, function(i,item){
            datos[i];
            valor_multi = valor_multi+datos[i].valor_total;


       })
       $.each(datos2, function(i,item){
             datos2[i];
             valor_multi_dis = valor_multi_dis+datos2[i].valor_total;

        })
        $.each(datos3, function(i,item){
              datos3[i];
              valor_multi_pu = valor_multi_pu+datos3[i].valor_total;
         })
    $('.actualizar').remove();


    $(".quitar50").each(function(i){

          var cantidad =$(this).find(".cantidad").val();
          var desc =$(this).find(".desc").val();
          var tipo =$(this).find(".tipo").val();
          var capacidad =$(this).find(".capacidad").val();
          var nFilas = $(".tabla tr").length - 1;


          if (cantidad != '' && desc!= '' && capacidad!='' && tipo!='') {
            operador1 = cantidad * datos[i].valor_uni;
            acumu1 = acumu1+ operador1;
            $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc+' - '+tipo+' de '+capacidad+' KVA'+'</td><td class="cant">'+cantidad+
            '</td><td><input type="text" class="form-control valor_uni" value="'+addCommas(datos[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni][]" required=""></td>'+' '+
            '<td><input type="text" class="form-control valor_multi" placeholder= "Valor" value="'+addCommas(operador1)+'" name="valores[valor_multi][]" required="" readonly ><input type="hidden"  value="'+datos[i].id+'"  name="valores[id][]"></td></tr>'+' '+
            '');

              event.preventDefault();

              $('.valor_uni').keyup(function(){
                var valor_uni = $(this).val().replace(/,/g,"");
                var cantidad = $(this).parent().parent().find(".cant").text();
                var resultado= valor_uni * cantidad;



                $(this).parent().parent().find('.valor_multi').val(addCommas(Math.round(resultado)));
                 valor_multi = 0;

                $(".valor_multi").each(function(i){
                       valor_multi = valor_multi + parseFloat($(this).val().replace(/,/g,"")) ;

                       var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                       var iva = subtotal*0.19;
                       var total = subtotal+iva;

                       $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));
                  });

                });
          }

      });


      $(".quitar51").each(function(i){

            var cantidad2 =$(this).find(".cantidad2").val();
            var desc2 =$(this).find(".desc2").val();
            var tipo2 =$(this).find(".tipo2").val();
            var nFilas = $(".tabla tr").length - 1;
            if (cantidad2 != '' && desc2!= '' && tipo2!='') {
              operador2 = datos2[i].valor_uni;
              acumu2 = acumu2+ operador2;
              $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td name="detalles2">'+desc2+' - '+tipo2+'</td><td>'+cantidad2+' mts.'+
              '</td><td><input type="text" class="form-control valor_uni_dis"  value="'+addCommas(datos2[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_dis][]" required="">'+' '+
              '</td><td><input type="text" class="form-control valor_multi_dis" placeholder= "Valor"  value="'+addCommas(operador2)+'" name="valores[valor_multi_dis][]" required="" readonly ><input type="hidden"  value="'+datos2[i].id+'"  name="valores[id_dis][]"></td></tr>'+' '+
              '');


                event.preventDefault();

                $('.valor_uni_dis').keyup(function(){

                  var valor_uni_dis = $(this).val().replace(/,/g,"");
                  var resultado2= valor_uni_dis;
                  $(this).parent().parent().find('.valor_multi_dis').val(addCommas(Math.round(resultado2)));
                  valor_multi_dis = 0;

                 $(".valor_multi_dis").each(function(i){
                        valor_multi_dis = valor_multi_dis + parseFloat($(this).val().replace(/,/g,"")) ;
                        var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                        var iva = subtotal*0.19;
                        var total = subtotal+iva;

                        $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));

                   });
                  });
            }
        });

        $(".quitar52").each(function(i){

              var cantidad3 =$(this).find(".cantidad3").val();
              var desc3 =$(this).find(".desc3").val();
              var tipo3 =$(this).find(".tipo3").val();
              var torre =$(this).find(".torre").val();
              var nFilas = $(".tabla tr").length - 1;

              if (cantidad3 != '' && desc3!= '' && tipo3!='') {
                operador3 = cantidad3 *datos3[i].valor_uni;
                acumu3 = acumu3+ operador3;
                $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc3+' - '+tipo3+'</td><td class="cant3">'+cantidad3+
                '</td><td><input type="text" class="form-control valor_uni_pu"  value="'+addCommas(datos3[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_pu][]" required=""></td>'+' '+
                '<td><input type="text" class="form-control valor_multi_pu" placeholder= "Valor"  value="'+addCommas(operador3)+'" name="valores[valor_multi_pu][]" required="" readonly > <input type="hidden"  value="'+datos3[i].id+'"  name="valores[id_pu][]"></td></tr>'+' '+
                '');
                  event.preventDefault();

                  $('.valor_uni_pu').keyup(function(){
                    var valor_uni_pu = $(this).val().replace(/,/g,"");
                    var cantidad3 = $(this).parent().parent().find(".cant3").text();
                    var resultado3= valor_uni_pu * cantidad3;
                    $(this).parent().parent().find('.valor_multi_pu').val(addCommas(Math.round(resultado3)));
                    valor_multi_pu = 0;

                     $(".valor_multi_pu").each(function(i){
                          valor_multi_pu = valor_multi_pu + parseFloat($(this).val().replace(/,/g,""));
                          var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                           var iva = subtotal*0.19;
                           var total = subtotal+iva;

                          $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));
                       });

                    });
              }


          });


    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Subtotal</label></td><td><label class="subtotal">${{ number_format($cotizaciones->subtotal,0)}}</label><input type="hidden" class="form-control subtotal" placeholder= "Valor" value="{{$cotizaciones->subtotal}}"  name="subtotal"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>IVA 19%</label></td><td><label class="iva">${{ number_format($cotizaciones->iva,0)}}</label><input type="hidden" class="form-control iva" placeholder= "Valor"  name="iva" value="{{$cotizaciones->iva}}"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Total</label></td><td><label class="total">${{ number_format($cotizaciones->total,0)}}</label><input type="hidden" class="form-control total" placeholder= "Valor" value="{{$cotizaciones->total}}" name="total"  required="" readonly></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Costo adicional de visita por dia si se requiere:</label></td><td><input type="text" class="form-control adici" placeholder= "Valor" onkeyup="mascara(this,cpf)" value="{{$cotizaciones->adicional}}" name="adici"  required="" ></td></tr>');
    $('.tabla tr:last').after('<input type="hidden" class="form-control valor_multi actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_dis actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_pu actualizar"  value="0"  >');
    var subtot= acumu1+acumu2+acumu3;
    var iva = subtot*0.19;
    var total = subtot+iva;
    $('.subtotal').text(addCommas(Math.round(subtot)));
    $('.subtotal').val(addCommas(Math.round(subtot)));
    $('.iva').text(addCommas(Math.round(iva)));
    $('.iva').val(addCommas(Math.round(iva)));
    $('.total').text(addCommas(Math.round(total)));
    $('.total').val(addCommas(Math.round(total)));
   });

});



$(document).ready(function(){

  var  tipo = $('#tipo').val();


  if (tipo == 'Aérea') {
    $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
    $(this).parent().parent().parent().find('#cajas').val('N.A');
    $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

  }
    else if (tipo == 'Subterránea') {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
      $(this).parent().parent().parent().find('#apoyos').val('N.A');
    }
    else {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
    }


  $('#cliente').change(function(){
      var valorCambiado =$(this).val();
      if((valorCambiado == "1")){
        $('#natural').css('display','block');
         $('#juridica').css('display','none');
         $("#select-natural").prop('required',true);
         $("#juri").prop('required',false);
       }
       else if(valorCambiado == "2")
       {
         $('#juridica').css('display','block');
          $('#natural').css('display','none');
          $("#juri").prop('required',true);
          $("#select-natural").prop('required',false);

       }
  });

$(document).on('change','#departamento',function(){

  var dep_id = $(this).val();
  var div = $(this).parents();
  var op=" ";
  $.ajax({
    type:'get',
    url:'{{ url('selectmuni')}}',
    data:{'id':dep_id},
    success:function(data){
    console.log(data);
    op+='<option value="0" selected disabled>Seleccione</option>';

    for (var i = 0; i < data.length; i++) {
      op+='<option value="' +data[i].id+ '">' +data[i].nombre+ '</option>'
    }

      div.find('#municipio').html(" ");
      div.find('#municipio').append(op);

    },
      error:function(){

    }
  });
});
});

$(document).on('change','#tipo',function(){

  var  tipo = $(this).val();

  if (tipo == 'Aérea') {
    $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
    $(this).parent().parent().parent().find('#cajas').val('N.A');
    $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

  }
    else if (tipo == 'Subterránea') {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
      $(this).parent().parent().parent().find('#apoyos').val('N.A');
    }
    else {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
    }


});



$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

  if (instalacion == 'Inspección RETIE proceso uso final residencial') {
    $(this).parent().parent().parent().find("#tipo3").html('');

    $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Casa">Casa</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Apartamentos">Apartamentos</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Zona común">Zona común</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Punto fijo">Punto fijo</option>');

  }
    else if (instalacion == 'Inspección RETIE proceso uso final comercial') {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Local comercial">Local comercial</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }
    else {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }

});

$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

    if(instalacion == 'Inspección RETIE proceso uso final residencial') {
      $(this).parent().parent().parent().find( "#torres" ).addClass( "torres" );
      $(this).parent().parent().parent().find( "#torre" ).addClass( "torre" );
      $('.torres').after(
          '<div class="col-md-2" id="estrato">'+' '+
            '<div class="form-group">'+' '+
              '<center><label >Estrato</label></center>'+' '+
              '<select class="form-control "name="pu_final[estrato_pu][]" style="width:100%">'+' '+
                '<option value="">Seleccione...</option>'+' '+
                '<option value="1">1</option>'+' '+
                '<option value="2">2</option>'+' '+
                '<option value="3">3</option>'+' '+
                '<option value="4">4</option>'+' '+
                '<option value="5">5</option>'+' '+
                '<option value="6">6</option>'+' '+
              '</select>'+' '+
            '</div>'+' '+
          '</div>');
          $(this).parent().parent().parent().parent().find( "#estrato" ).addClass( "borrar2" );
          $('.borrar2').remove();
          $('.torre').after(
              '<div class="col-md-2" id="estrato">'+' '+
                '<div class="form-group">'+' '+
                  '<center><label >Estrato</label></center>'+' '+
                  '<select class="form-control "name="pu_final[estrato_pu][]" style="width:100%">'+' '+
                    '<option value="">Seleccione...</option>'+' '+
                    '<option value="1">1</option>'+' '+
                    '<option value="2">2</option>'+' '+
                    '<option value="3">3</option>'+' '+
                    '<option value="4">4</option>'+' '+
                    '<option value="5">5</option>'+' '+
                    '<option value="6">6</option>'+' '+
                  '</select>'+' '+
                '</div>'+' '+
              '</div>');
          $("select").select2();
          $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );
          $(this).parent().parent().parent().find( "#torre" ).removeClass( "torre" );
    }
    else {
      $(this).parent().parent().parent().parent().find( "#estrato" ).addClass( "borrar2" );
      $('.borrar2').remove();
    }


});

$(document).on('change','#kv',function(){

  var  kv = $(this).val();

  if (kv == '13,2') {
    $('#nivel').val('13,2');
  }
    else if (kv == '13,4') {
      $('#nivel').val('13,4');
    }
    else if (kv == '13,8') {
      $('#nivel').val('13,8');
    }
    else {
      $('#nivel').val('No aplica');
    }
});


$(document).on('change','.tipo3',function(){

  var  tipo = $(this).val();

    if (tipo == 'Apartamentos') {
      $(this).parent().parent().parent().find( "#torres" ).addClass( "torres" );
      $(this).parent().parent().parent().find( "#torre" ).addClass( "torre" );
      $('.torres').after(
        '<div class="col-md-1 " id="borrar">'+' '+
          '<div class="form-group">'+' '+
            '<center><label >#Torres</label></center>'+' '+
              '<input type="text" class="form-control torre" value="" placeholder= "Cantidad" name="pu_final[torres][]">'+' '+
            '</div>'+' '+
          '</div>'
    );
    $(this).parent().parent().parent().parent().find( "#borrar" ).addClass( "borrar" );
    $('.borrar').remove();
    $('.torre').after(
      '<div class="col-md-1 " id="borrar">'+' '+
        '<div class="form-group">'+' '+
          '<center><label >#Torres</label></center>'+' '+
            '<input type="text" class="form-control torre" value="" placeholder= "Cantidad" name="pu_final[torres][]">'+' '+
          '</div>'+' '+
        '</div>'
  );

    $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );
    $(this).parent().parent().parent().find( "#torre" ).removeClass( "torre" );

    }
    else {
      $(this).parent().parent().parent().parent().find( "#borrar" ).addClass( "borrar" );
      $('.borrar').remove();
    }
});

var form = $("#form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
      if (validar == 0) {
        alert('Presione el boton generar tabla para precios');
      }
      else {
        $("#form").submit();
      }

    }
});
</script>




@endsection
