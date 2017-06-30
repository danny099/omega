@extends('index')
<style media="screen">
.separar{
  height: 80px;
}
</style>
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Crear transformaciones</li>
</ol>
  <form class="" action="{{ url('transformaciones') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="box-header with-border">
        <center> <h3 >Alcance: proceso de transformación</h3> </center>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select" >
                  <option value="">Seleccione...</option>
                  @foreach($codigos as $codigo)
                  <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center ><label >Código Cotizacion</label></center>
                <select class="form-control select2" name="codigo_cotizacion" style="width: 100%" id="select">
                  <option value="">Seleccione...</option>
                  @foreach($cotizaciones as $cotizacion)
                  <option value="{{ $cotizacion->id }}">{{ $cotizacion->codigo }}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row quitar50" id="quitar50">
          <center> <h3>Alcance: proceso de transformación</h3> </center>

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
          <div class="col-md-2">
            <div class="form-group">
              <center class="separar"><label >Nivel de tensión (KV) </label></center>
              <select class="form-control" name="transformacion[nivel_tension][]" style="width:100%">
                <option value="">Seleccione...</option>
                <option value="13,2">13,2</option>
                <option value="13,4">13,4</option>
                <option value="13,8">13,8</option>
              </select>
            </div>
          </div>
          <div class="col-md-1">
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
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">
          Guardar
        </button>
      </div>
    </div>
  </form>
@endsection
