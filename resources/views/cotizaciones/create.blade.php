@extends('index')
<style media="screen">
.separar{
  height: 80px;
}
  select{
    font-size: 15px;
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
  <li class="active">Crear cotización</li>
</ol>

  <div class="box box-primary" >
    <div class="box-header with-border">
      <center> <h3>Cotización</h3> <h3>{{ $codigo }}</h3></center>
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
  <form role="form" name="" action="{{ url('cotizaciones') }}" method="post" id="example-form" autocomplete="off">
    {{csrf_field()}}
    <div class="">
    <h3>Paso 1</h3>
    <section>
    <input type="hidden" name="codigo" value="{{ $codigo }}">
    <div class="row">
      <center> <h3>Datos</h3> </center>

      <div class="col-md-12">
        <div class="col-md-3">
          <label>Dirigido a :</label>
          <select name="dirigido" id="dirigido" style="width:100%">
            <option value="">Seleccione...</option>
            <option value="Señor">Señor</option>
            <option value="Señora">Señora</option>
            <option value="Señores">Señores</option>
            <option value="Ingeniero">Ingeniero</option>
            <option value="Ingeniera">Ingeniera</option>
            <option value="Arquitecto">Arquitecto</option>
            <option value="Arquitecta">Arquitecta</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>Tipo de régimen</label>
          <select class="" name="tipo_regimen" id="cliente" style="width: 100%" required="">
            <option value="">Seleccione...</option>
            <option value="1">Persona natural</option>
            <option value="2">Persona jurídica</option>
          </select>
        </div>
        <div class="col-md-3" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class=" select2" name="cliente_id" style="width: 100%" id="select-natural">
            <option value="">Seleccione...</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3" style="Display:none" style="width: 100%" id="juridica">
          <label >Persona jurídica  </label>
          <select class="" name="juridica_id" style="width: 100%" id="juri">
            <option value="">Seleccione...</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Nombre del proyecto:</label>
          <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre" required="Ingrese nombre del proyecto">
        </div>
        <div class="col-md-3">
          <label>Departamento</label>

          <select class="form-control" name="departamento" style="width:100%" id="departamento" required="">
            @foreach($departamentos as $departamento)
            <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3"id="natural">
          <label >Municipio</label>
          <select class="form-control" name="municipio" style="width:100%" id="municipio" required="">
            <option value=""></option>
          </select>
        </div>
      </div>
    </div>
      <div class="row">

      <center> <h3>Detalle de la cotización</h3> </center>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Formas de pago :</label>
          <select name="formas_pago" style="width:100%" required>
            <option value="">Seleccione...</option>
            <option value="Anticipo 100%">Anticipo 100%</option>
            <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
            <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
            <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
            <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>Tiempo de ejecución</label>
          <input type="text"  class="form-control" name="tiempo" value="Acordado con el cliente">
        </div>
        <div class="col-md-3">
          <label>Tiempo de entrega de dictámenes</label>
          <input type="text"  class="form-control" name="entrega" value="4 días  hábiles">
        </div>
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Número  de visitas contratadas</label>
          <input type="text"  class="form-control" name="visitas" value="2">
        </div>
        <div class="col-md-3">
          <label>Validez de la oferta</label>
          <input type="text" class="form-control" name="validez" value="30 días  ">
        </div>
      </div>

    </div>
  </section>
    <h3>Paso 2</h3>
      <section>
      <div class="box-body" style="width: 110%">
        <div class="row quitar51" id="quitar51">
          <div class="col-md-12"  style="margin-bottom: 10px;">
            <center> <h3>Alcance: proceso de distribución en MT</h3> </center>
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <center class="separar"><label >Descripción</label></center>
                <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en MT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Tipo</label></center>
                <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                  <option value="">Seleccione...</option>
                  <option value="Aérea">Tipo Aérea</option>
                  <option value="Subterránea">Tipo subterránea</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Nivel de tensión (KV)  </label></center>
                <select class="form-control tipo2 tension" name="distribucion[nivel_tension_dis][]" style="width:100%" id="kv">
                  <option value="">Seleccione...</option>
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
                <input type="text" class="form-control cantidad2" placeholder= "Cantidad" onkeyup="mascara(this,cpf)" name="distribucion[cantidad_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Apoyos o estructuras</label></center>
                <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" >
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cajas de inspección</label></center>
                <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" name="distribucion[cajas_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Notas</label></center>
                <input type="text" class="form-control" placeholder= "Notas" name="distribucion[notas_dis][]">
              </div>
            </div>
            <div class="col-md-1 tblprod13" id="tblprod13" >
              <div class="form-group">
                <center class="separar"></center>

                <a class="btn btn-primary" data-toggle="modal" id="btnadd13" href="#" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
        </div>
      </div>
      <div class="row quitar50" id="quitar50">
        <center> <h3>Alcance: proceso de transformación</h3> </center>
        <input type="hidden" id="nivel" name="valor" value="">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center class="separar"><label >Descripción</label></center>
            <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center class="separar"><label >Tipo</label></center>
            <select class="form-control tipo" name="transformacion[tipo][]" style="width:100%">
              <option value="">Seleccione...</option>
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
              <option value="">Seleccione...</option>
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
              <input type="text" class="form-control capacidad" placeholder="Capacidad"   name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center class="separar"><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center class="separar"><label >Refrigeración </label></center>
            <select class="form-control" name="transformacion[tipo_refrigeracion][]" style="width:100%">
              <option value="">Seleccione...</option>
              <option value="Seco">Seco</option>
              <option value="Aceite">Aceite</option>
            </select>
          </div>
        </div>
        <div class="col-md-1 " id="tblprod10">
          <div class="form-group">
            <center class="separar"></center>

            <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd10" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row quitar51" id="quitar51">
      <div class="col-md-12"  style="margin-bottom: 10px;">
        <center> <h3>Alcance: proceso de distribución en BT</h3> </center>
      </div>
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center class="separar"><label >Descripción</label></center>
            <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en BT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center class="separar"><label >Tipo</label></center>
            <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
              <option value="">Seleccione...</option>
              <option value="Aérea">Tipo Aérea</option>
              <option value="Subterránea">Tipo subterránea</option>
            </select>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center class="separar"><label >Nivel de tensión (KV)  </label></center>
            <select class="form-control tipo2" name="distribucion[nivel_tension_dis][]" style="width:100%" id="tension">
              <option value="">Seleccione...</option>
              <option value="110-220">110-220</option>
              <option value="220-240">220-240</option>
              <option value="No aplica">No aplica</option>
            </select>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center class="separar"><label >Longitud de red (mts.)</label></center>
            <input type="text" class="form-control cantidad2" placeholder= "Cantidad" onkeyup="mascara(this,cpf)" name="distribucion[cantidad_dis][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center class="separar"><label >Apoyos o estructuras</label></center>
            <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" >
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center class="separar"><label >Cajas de inspección</label></center>
            <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" name="distribucion[cajas_dis][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center class="separar"><label >Notas</label></center>
            <input type="text" class="form-control" placeholder= "Notas" name="distribucion[notas_dis][]">
          </div>
        </div>
        <div class="col-md-1 tblprod11" id="tblprod11" >
          <div class="form-group">
            <center class="separar"></center>

            <a class="btn btn-primary" data-toggle="modal" id="btnadd11" href="#" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
    </div>
  </div>
    <div class="row quitar52" id="quitar52">
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>
      <div class="col-md-12">
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control desc3"name="pu_final[descripcion_pu][]" style="width:100%" id="instalacion">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
            <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
            <option value="Inspección RETIE proceso uso final industrial">Inspección RETIE proceso uso final industrial</option>
          </select>
        </div>
      </div>
      <div class="col-md-2 " id="torres">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">

          </select>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control cantidad3" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
        </div>
      </div>
      <div class="col-md-1 m2">
        <div class="form-group">
          <center><label >m²</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[metros_pu][]">
        </div>
      </div>
      <div class="col-md-1 kva">
        <div class="form-group">
          <center><label >KVA</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[kva_pu][]">
        </div>
      </div>
      <div class="col-md-1 tblprod12" id="tblprod12" >
        <div class="form-group">
          <center></center>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd12" style="background-color: #fdea08; border-color:#fdea08; margin-top: 34px;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
    </div>
    </div>
      <div class="col-md-12">
        <center> <h3>Observaciones</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" ></textarea>
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
         <th><center><label> Ítem</label></center></th>
         <th><center><label> Descripción del alcance</label></center></th>
         <th><center><label> Cantidad</label></center></th>
         <th><center><label> Valor unitario</label></center></th>
         <th><center><label> Valor</label></center></th>
         <th><center><label> <button type="button" class="btn btn-primary generar" style="background-color: #33579A; border-color:#33579A;" name="button">Generar tabla para precios</button></label></center></th>

       </tr>

     </table>
     <br>

   </section>
   </div>
  </form>
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
    $('.actualizar').remove();


    $(".quitar50").each(function(i){

          var cantidad =$(this).find(".cantidad").val();
          var desc =$(this).find(".desc").val();
          var tipo =$(this).find(".tipo").val();
          var capacidad =$(this).find(".capacidad").val();
          var nFilas = $(".tabla tr").length - 1;

          if (cantidad != '' && desc!= '' && capacidad!='' && tipo!='') {

            $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc+' - '+tipo+' de'+capacidad+' KVA'+'</td><td class="cant">'+cantidad+
            '</td><td><input type="text" class="form-control valor_uni" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni][]" required=""></td><td><input type="text" class="form-control valor_multi" placeholder= "Valor"  value="0" name="valores[valor_multi][]" required="" readonly ></td></tr>');

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


      $(".quitar51").each(function(){

            var cantidad2 =$(this).find(".cantidad2").val();
            var desc2 =$(this).find(".desc2").val();
            var tipo2 =$(this).find(".tipo2").val();
            var nFilas = $(".tabla tr").length - 1;
            if (cantidad2 != '' && desc2!= '' && tipo2!='') {

              $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td name="detalles2">'+desc2+' - '+tipo2+'</td><td>'+cantidad2+' mts.'+
              '</td><td><input type="text" class="form-control valor_uni_dis" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_dis][]" required=""></td><td><input type="text" class="form-control valor_multi_dis" placeholder= "Valor" value="0" name="valores[valor_multi_dis][]" required="" readonly ></td></tr>');
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

        $(".quitar52").each(function(){

              var cantidad3 =$(this).find(".cantidad3").val();
              var desc3 =$(this).find(".desc3").val();
              var tipo3 =$(this).find(".tipo3").val();
              var torre =$(this).find(".torre").val();
              var nFilas = $(".tabla tr").length - 1;

              if (cantidad3 != '' && desc3!= '' && tipo3!='') {

                $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc3+' - '+tipo3+'</td><td class="cant3">'+cantidad3+
                '</td><td><input type="text" class="form-control valor_uni_pu" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_pu][]" required=""></td><td><input type="text" class="form-control valor_multi_pu" placeholder= "Valor" value="0" name="valores[valor_multi_pu][]" required="" readonly ></td></tr>');
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


    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Subtotal</label></td><td><label class="subtotal">0</label><input type="hidden" class="form-control subtotal" placeholder= "Valor" value="0"  name="subtotal"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>IVA 19%</label></td><td><label class="iva">0</label><input type="hidden" class="form-control iva" placeholder= "Valor"  name="iva" value="0"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Total</label></td><td><label class="total">0</label><input type="hidden" class="form-control total" placeholder= "Valor" value="0" name="total"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Costo adicional de visita por día si se requiere:</label></td><td><input type="text" class="form-control adici" placeholder= "Valor" onkeyup="mascara(this,cpf)" value="600,000" name="adici"  required="" ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Metodo de pago:</label></td><td><div class="radio" style="margin-left: 20px;"><input type="radio" name="pago" value="0" checked required="required"> General </div><div class="radio" style="margin-left: 20px;"><input type="radio" name="pago" value="1" required="required"> Outsourcing</div></td></tr>');
    $('.tabla tr:last').after('<input type="hidden" class="form-control valor_multi actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_dis actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_pu actualizar"  value="0"  >');


   });

});


$(document).ready(function(){


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

  $('#dirigido').change(function(){
      var valorCambiado =$(this).val();
      if((valorCambiado == "Señor" || valorCambiado == "Señora")){
        $('#natural').css('display','block');
        $('#juridica').css('display','none');
         $('#cliente').html('');
         $('#cliente').append('<option value="1">Persona natural</option>');
         $('#cliente').append('<option value="2">Persona juridica</option>');
         $("#select-natural").prop('required',true);
         $("#juri").prop('required',false);
       }
       else
       {
         $('#juridica').css('display','block');
          $('#natural').css('display','none');
          $('#cliente').html('');
          $('#cliente').append('<option value="2">Persona juridica</option>');
          $('#cliente').append('<option value="1">Persona natural</option>');
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
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Casa">Casa</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Apartamentos">Apartamentos</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Zona común">Zona común</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Punto fijo">Punto fijo</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Acometidas">Acometidas</option>');


  }
    else if (instalacion == 'Inspección RETIE proceso uso final comercial') {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Local comercial">Local comercial</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }
    else {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }

});


$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

    if(instalacion == 'Inspección RETIE proceso uso final residencial') {
      $(this).parent().parent().parent().find( "#torres" ).addClass( "torres" );
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
          $("select").select2();
          $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );
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
      $('.torres').after(
        '<div class="col-md-1 " id="borrar">'+' '+
          '<div class="form-group">'+' '+
            '<center><label >#Torres</label></center>'+' '+
              '<input type="text" class="form-control torre" value="" placeholder= "Cantidad" name="pu_final[torres][]">'+' '+
            '</div>'+' '+
          '</div>'
    );
    $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );

    }
    else {
      $(this).parent().parent().parent().parent().find( "#borrar" ).addClass( "borrar" );
      $('.borrar').remove();
    }

    if (tipo == 'Acometidas') {
      $(this).parent().parent().parent().parent().find('.m2').hide();
      $(this).parent().parent().parent().parent().find('.kva').hide();
      $(this).parent().parent().parent().parent().find('#estrato').hide();
      $(this).parent().parent().parent().parent().find('.quitar52').after('<input type="hidden" class="form-control" placeholder= "Cantidad" name="pu_final[metros_pu][]" value="N.A">');
      $(this).parent().parent().parent().parent().find('.quitar52').after('<input type="hidden" class="form-control" placeholder= "Cantidad" name="pu_final[kva_pu][]" value="N.A">');

    }
    else {
      $(this).parent().parent().parent().parent().find('.m2').show();
      $(this).parent().parent().parent().parent().find('.kva').show();
      $(this).parent().parent().parent().parent().find('#estrato').show();
    }
});





var form = $("#example-form");
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
        $("#example-form").submit();
      }

    }
});
</script>




@endsection
