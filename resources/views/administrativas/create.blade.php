@extends('index')
<style media="screen">

  textarea{
    width:100%;
  }
</style>
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
function calcular(){
  var varMonto;
  var varIva;
  var varSubTotal;

  varMonto = document.getElementById("fin").value;
  varMonto = varMonto.replace(/[\,]/g,'');

  varIva = parseFloat(varMonto) * 0.16;
  document.getElementById("iva").value = addCommas(Math.round(varIva)) ;

  varSubTotal = parseFloat(varMonto) - parseFloat(varIva);
  document.getElementById("ini").value = addCommas(Math.round(varSubTotal)) ;

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
</script>
@section('contenido')

  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
    <li class="active">Crear Proyecto</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Datos del proyecto</h3> </center>
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
  <form role="form" name="form1" action="{{ url('administrativas') }}" method="post" >
    {{ csrf_field() }}
    <div class="box-body">
        <div class="col-md-4">
          <div class="form-group">
            <label>Código del proyecto:</label>
            <input id="codigo" type="text" class="form-control" placeholder="Ingrese código"  name="codigo" required pattern="[A-Z]{3}[-]{1}[0-9]{4}[-]{1}[0-9]{3}">
          </div>
          <div class="form-group">
            <label>Nombre del proyecto</label>
            <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre" required="Ingrese nombre del proyecto">
          </div>
          <div class="form-group">
            <label>Fecha del contrato:</label>
            <input type="date" class="form-control pull-right" name="fecha" id="datepicker" required="Ingrese una fecha">
          </div>
          <div class="form-group">
            <label>Tipo de régimen</label>
            <select class="form-control" name="cliente_id" id="cliente" required="">
              <option value="">Seleccione...</option>
              <option value="1">Persona natural</option>
              <option value="2">Persona jurídica</option>
            </select>
          </div>
          <div class="form-group" style="Display:none" id="natural">
            <label >Persona natural</label>
            <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
              <option value="">Seleccione...</option>
              @foreach($clientes as $cliente)
              <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group" style="Display:none" style="width: 100%" id="juridica">
            <label >Persona juridica</label>
            <select class="form-control" name="juridica_id" style="width: 100%" id="juri">
              <option value="">Seleccione...</option>
              @foreach($juridicas as $juridica)
              <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label >Departamento</label>
            <select class="form-control" name="departamento" id="departamento" required="">
              @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
            <select class="form-control" name="municipio" id="municipio" required="">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label >Tipo de zona</label>
            <select class="form-control" name="zona">
              <option value="Urbana">Urbana</option>
              <option value="Rural">Rural</option>
              <option value="Urbana/Rural">Urbana/Rural</option>
            </select>
          </div>
          <div class ="form-group">
            <label >Valor contrato final</label>
            <input type="text" min="0" class="form-control" id="fin" autocomplete="off" placeholder= "Valor final" name="contrato_final"  onkeyup="calcular();"  onkeypress="mascara(this,cpf)"  onpaste="return false" required="ingrese así sea un cero" >

          </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
              <label >Valor IVA</label>
              <input type="text" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor IVA" name="iva"   >

            </div>
            <div class="form-group">
              <label >Valor antes de IVA</label>

              <input type="text" min="0" id="ini" class="form-control"  readonly="readonly" placeholder= "Valor antes IVA" name="contrato_inicial" >

            </div>

            <div class="form-group">
              <label >Plan de pago</label>
              <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago" required="">
            </div>
        </div>
        <hr>
        </div>


  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Alcance: proceso de transformación</h3> </center>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="transformacion[tipo][]">
              <option value="">Seleccione...</option>
              <option value="Tipo_poste">Tipo poste</option>
              <option value="Tipo_interior">Tipo interior</option>
              <option value="Tipo_exterior">Tipo exterior</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Capacidad</label></center>
              <input type="text" class="form-control" placeholder="Capacidad"   name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label>Unidad</label></center>
            <center>
              <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]">
            </center>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-1 tblprod2" >
          <div class="form-group">
            <br>
            <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de distribución</h3> </center>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control" name="distribucion[descripcion_dis][]">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
            <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="distribucion[tipo_dis][]">
            <option value="">Seleccione...</option>
            <option value="Aérea">Tipo Aérea</option>
            <option value="Subterránea">Tipo subterránea</option>
            <option value="Aérea/subterránea">Aérea/subterránea</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Unidad</label></center>
          <center>
            <input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center">
          </center>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">
        </div>
      </div>
      <div class="col-md-1 tblprod3" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control"name="pu_final[descripcion_pu][]">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
            <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="pu_final[tipo_pu][]">
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
          <center><label >Unidad</label></center>
          <center>
            <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]">
          </center>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
        </div>
      </div>
      <div class="col-md-1 tblprod4" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd4" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Observaciones de estado administrativo del proyecto</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" required=""></textarea>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" data-target="" data-toggle="  " class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
    </div>
  </div>
  </form>
</div>
</div>


@endsection

@section('scripts')


<script type="text/javascript">
$(document).ready(function(){
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

$(document).ready(function($){
$('#codigo').inputmask('CPS-9999-999');



});

</script>
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>



@endsection
