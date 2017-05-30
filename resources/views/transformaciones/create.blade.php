@extends('index')

@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li class="active">Crear transformaciones</li>
</ol>
  <form class="" action="{{ url('transformaciones') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="box-header with-border">
        <center> <h3 class="box-title">Alcance: proceso de transformación</h3> </center>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select" required="">
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
            <div class="col-md-3">
              <div class="form-group">
                <center><label >Descripción</label></center>
                <input type="text" class="form-control" value="Inspección RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Tipo</label></center>
                <select class="form-control" name="transformacion[tipo][]">
                  <option value="">Seleccione...</option>
                  <option value="Tipo_poste">tipo poste</option>
                  <option value="Tipo_interior">tipo interior</option>
                  <option value="Tipo_exterior">tipo exterior</option>
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

            <div class="col-md-1 tblprod2">
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">
          Guardar
        </button>
      </div>
    </div>
  </form>
@endsection
