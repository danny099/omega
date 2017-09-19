@extends('index')
<style media="screen">
.separar{
  height: 80px;
}
</style>
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Crear distribuciones</li>
</ol>
@if(Session::has('message'))
  <div id="alert">
    <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
    <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{Session::get('message')}}
    </div>
  </div>
@endif
  <form class="form" action="{{ url('distribuciones') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de distribución</h3> </center>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select">
                  <option value="">Seleccione...</option>
                  @foreach($codigos as $codigo)
                  <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}} - {{$codigo->nombre_proyecto}}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Cotización</label></center>
                <select class="form-control select2" name="codigo_cotizacion" style="width: 100%" id="select">
                  <option value="">Seleccione...</option>
                  @foreach($cotizaciones as $cotizacion)
                  <option value="{{ $cotizacion->id }}">{{$cotizacion->codigo}} - {{$cotizacion->nombre}}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row quitar51" id="quitar51">
          <div class="col-md-12"  style="margin-bottom: 10px;">
            <center> <h3>Alcance: proceso de distribución</h3> </center>
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <center class="separar"><label >Descripción</label></center>
                <select class="form-control desc2" name="distribucion[descripcion_dis][]" style="width:100%" id="desc">
                  <option value="">Seleccione...</option>
                  <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
                  <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
                </select>
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
                <center class="separar"><label >Nivel de tensión  </label></center>
                <select class="form-control tipo2 tension" name="distribucion[nivel_tension_dis][]" style="width:100%" id="tension">
                  <option value="">Seleccione...</option>

                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Longitud de red (km)</label></center>
                <input type="text" class="form-control cantidad2" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Apoyos o estructuras</label></center>
                <input type="number" id="apoyos" class="form-control" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" >
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cajas de inspección</label></center>
                <input type="number" id="cajas" class="form-control" placeholder= "Cantidad" name="distribucion[cajas_dis][]">
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
                <a class="btn btn-primary" data-toggle="modal" id="btnadd100" href="#" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
        </div>
      </div>
        <button type="submit" id="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">
          Guardar
        </button>
      </div>
    </div>
  </form>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).on('change','#tipo',function(){

  var  tipo = $(this).val();

  if (tipo == 'Aérea') {
    $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
    $(this).parent().parent().parent().find('#cajas').val(0);
    $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

  }
    else if (tipo == 'Subterránea') {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
      $(this).parent().parent().parent().find('#apoyos').val(0);
    }
    else {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
    }


});

$(document).on('change','#desc',function(){

  var  desc = $(this).val();

  if (desc == 'Inspección RETIE proceso de distribución en MT') {
    $(this).parent().parent().parent().find("#tension").html('');
    $(this).parent().parent().parent().find("#tension").append('<option value="13,2">13,2</option>');
    $(this).parent().parent().parent().find("#tension").append('<option value="13,4">13,4</option>');
    $(this).parent().parent().parent().find("#tension").append('<option value="13,8">13,8</option>');
    $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');

  }
    else {
      $(this).parent().parent().parent().find("#tension").html('');
      $(this).parent().parent().parent().find("#tension").append('<option value="110-220">110-220</option>');
      $(this).parent().parent().parent().find("#tension").append('<option value="220-240">220-240</option>');
      $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');
    }


});

</script>
@endsection
