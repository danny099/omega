@extends('index')
<style media="screen">

  textarea{
    width:100%;
    resize: none;
  }

</style>
<link rel="stylesheet" href=" {{ url('bootstrap/css/jquery.steps.css')}}">
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Cotizaciones</li>
</ol>

  <div class="box box-primary" >
    <div class="box-header with-border">
      <center> <h3>Cotización</h3> </center>
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
  <form role="form" name="" action="{{ url('cotizaciones') }}" method="post" id="example-basic">
    {{ csrf_field() }}
    <h3>Paso 1</h3>
    <section>
    <div class="box-header with-border">
      <div class="col-md-12">
        <div class="col-md-3">
          <label>Dirigido a :</label>
          <select name="pu_final[dirigido][]" style="width:100%">
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

      </div>
      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
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
          <label >Persona juridica</label>
          <select class="" name="juridica_id" style="width: 100%" id="juri">
            <option value="">Seleccione...</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-1">
          <label>Objeto:</label>
        </div>
        <div class="col-md-11 form-group">
          <div class="col-md-12 form-group">
          <p> Este Documento Constituye la Oferta Tecnica y Economica para la prestacion de servicios de inspectoria RETIE a las instalaciones electricas en inspección RETIE proyecto
          </div>
            <div class="col-md-4">
              <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre" required="Ingrese nombre del proyecto">
            </div>
            <div class="col-md-2">
                ubicado en el Municipio de
            </div>
            <div class="col-md-2">
              <select class="form-control" name="municipio" id="municipio" required="">
                <option value=""></option>
              </select>
            </div>
            <div class="col-md-2">
              departamento del
            </div>
            <div class="col-md-2">
              <select class="form-control" name="departamento" id="departamento" required="">
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
                @endforeach
              </select>
            </div>
          </p>
        </div>
      </div>


      <center> <h3>Alcance: proceso de transformación</h3> </center>
    </div>
    <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control tipo" name="transformacion[tipo][]">
              <option value="">Seleccione...</option>
              <option value="Tipo_poste">Tipo poste</option>
              <option value="Tipo_interior">Tipo interior</option>
              <option value="Tipo_exterior">Tipo exterior</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Nivel de tencion (kv)</label></center>
            <select class="form-control" name="transformacion[nivel_tension][]">
              <option value="">Seleccione...</option>
              <option value="13,2">13,2</option>
              <option value="13,4">13,4</option>
              <option value="13,8">13,8</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Capacidad</label></center>
              <input type="text" class="form-control capacidad" placeholder="Capacidad"   name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >refrigeración </label></center>
            <select class="form-control" name="transformacion[tipo_refrigeracion][]">
              <option value="">Seleccione...</option>
              <option value="Seco">Seco</option>
              <option value="Aceite">Aceite</option>
            </select>
          </div>
        </div>
        <div class="col-md-1 " id="tblprod10">
          <div class="form-group">
            <br>
            <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd10" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"  style="margin-bottom: 10px;">
        <center> <h3>Alcance: proceso de distribución</h3> </center>
      </div>
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center style="margin-bottom: 25px;"><label >Descripción</label></center>
            <select class="form-control desc2" name="distribucion[descripcion_dis][]" style="top:25px important!">
              <option value="">Seleccione...</option>
              <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
              <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center style="margin-bottom: 25px;"><label >Tipo</label></center>
            <select class="form-control tipo2" name="distribucion[tipo_dis][]" >
              <option value="">Seleccione...</option>
              <option value="Aérea">Tipo Aérea</option>
              <option value="Subterránea">Tipo subterránea</option>
              <option value="Aérea/subterránea">Aérea/subterránea</option>
            </select>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center><label >Nivel de tensión  </label></center>
            <input type="text" class="form-control" placeholder= "Longitud" name="distribucion[nivel_tension_dis][]">
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center><label >longitud de red (km)</label></center>
            <input type="text" class="form-control cantidad2" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >apoyos o estructuras</label></center>
            <input type="number" class="form-control" placeholder= "Cantidad" name="distribucion[apoyos_dis][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >cajas de inspección</label></center>
            <input type="number" class="form-control" placeholder= "Cantidad" name="distribucion[cajas_dis][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center style="margin-bottom: 25px;"><label >Notas</label></center>
            <input type="text" class="form-control" placeholder= "Notas" name="distribucion[notas_dis][]">
          </div>
        </div>
        <div class="col-md-1 tblprod11" id="tblprod11" >
          <div class="form-group">
            <br>
            <a class="btn btn-primary" data-toggle="modal" id="btnadd11" href="#" style="background-color: #fdea08; border-color:#fdea08;margin-top: 29px;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>
      <div class="col-md-12">
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control desc3"name="pu_final[descripcion_pu][]">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
            <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control tipo3" name="pu_final[tipo_pu][]">
            <option value="">Seleccione...</option>
            <option value="Casa">Casa</option>
            <option value="Apartamentos">Apartamentos</option>
            <option value="Zona común">Zona común</option>
            <option value="Local comercial">Local comercial</option>
            <option value="Punto fijo">Punto fijo</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Estrato</label></center>
          <select class="form-control"name="pu_final[estrato_pu][]">
            <option value="">Seleccione...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control cantidad3" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <center><label >m²</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[metros_pu][]">
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <center><label >KVA</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[kva_pu][]">
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <center><label >Acomedidas</label></center>
          <input type="number" class="form-control" placeholder= "Cantidad" name="pu_final[acomedidas_pu][]">
        </div>
      </div>
      <div class="col-md-1 tblprod12" id="tblprod12" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd12" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
    </div>
    </div>
      <div class="col-md-12">
        <center> <h3>Observaciones de estado administrativo del proyecto</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" required=""></textarea>
      </div>
    </div>

</section>
  <h3>Paso 2</h3>
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
       </tr>

     </table>
     <button type="submit" data-target="" data-toggle="  " class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
   </section>
  </form>
  </div>

@endsection



@section('scripts')


<script type="text/javascript">
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
   $(".sgte").on("click",function( event ) {
    count++;
    var x= $().val();



    var cantidad = $(".cantidad").val().replace(/,/g,"");
    var desc = $(".desc").val().replace(/,/g,"");
    var tipo = $(".tipo").val().replace(/_/g," ");
    var capacidad = $(".capacidad").val().replace(/,/g," ");
    var nFilas = $(".tabla tr").length - 1;

    if (cantidad != '' && desc!= '' && capacidad!='' && tipo!='') {

      $('.tabla tr:last').after('<tr><td>'+nFilas+'</td><td>'+desc+' '+tipo+' '+capacidad+'</td><td>'+cantidad+
      '</td><td><input type="text" class="form-control valor_uni" placeholder= "Valor" onkeypress="mascara(this,cpf)" name="valor_uni" required=""></td><td><input type="text" class="form-control valor_multi" placeholder= "Valor"  name="valor_multi" required="" readonly ></td></tr>');
        event.preventDefault();

        $('.valor_uni').keyup(function(){
          var valor_uni = $(this).val().replace(/,/g,"");
          var cant = cantidad;
          var resultado= valor_uni * cant;

          $(this).parent().parent().find('.valor_multi').val(addCommas(Math.round(resultado)));

          });
    }

    var cantidad2 = $(".cantidad2").val().replace(/,/g,"");
    var desc2 = $(".desc2").val().replace(/,/g,"");
    var tipo2 = $(".tipo2").val().replace(/_/g," ");
    var nFilas = $(".tabla tr").length - 1;


    if (cantidad2 != '' && desc2!= '' && tipo2!='') {

      $('.tabla tr:last').after('<tr><td>'+nFilas+'</td><td>'+desc2+' '+tipo2+'</td><td>'+cantidad2+' km'+
      '</td><td><input type="text" class="form-control valor_uni_dis" placeholder= "Valor" onkeypress="mascara(this,cpf)" name="valor_uni_dis" required=""></td><td><input type="text" class="form-control valor_uni_dis" placeholder= "Valor"  name="valor_uni_dis" required="" readonly ></td></tr>');
        event.preventDefault();

        $('.valor_uni_dis').keyup(function(){
          var valor_uni_dis = $(this).val().replace(/,/g,"");
          var resultado= valor_uni_dis;

          $(this).parent().parent().find('.valor_uni_dis').val(addCommas(Math.round(resultado)));

          });
    }

    var cantidad3 = $(".cantidad3").val().replace(/,/g,"");
    var desc3 = $(".desc3").val().replace(/,/g,"");
    var tipo3 = $(".tipo3").val().replace(/_/g," ");
    var nFilas = $(".tabla tr").length - 1;


    if (cantidad3 != '' && desc3!= '' && tipo3!='') {

      $('.tabla tr:last').after('<tr><td>'+nFilas+'</td><td>'+desc3+' '+tipo3+'</td><td>'+cantidad3+
      '</td><td><input type="text" class="form-control valor_uni_pu" placeholder= "Valor" onkeypress="mascara(this,cpf)" name="valor_uni_pu" required=""></td><td><input type="text" class="form-control valor_multi_pu" placeholder= "Valor"  name="valor_multi_pu" required="" readonly ></td></tr>');
        event.preventDefault();

        $('.valor_uni_pu').keyup(function(){
          var valor_uni_pu = $(this).val().replace(/,/g,"");
          var cant3 = cantidad3;
          var resultado= valor_uni_pu * cant3;

          $(this).parent().parent().find('.valor_multi_pu').val(addCommas(Math.round(resultado)));

          });
    }

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

$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
</script>




@endsection
