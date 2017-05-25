@extends('index')
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li class="active">Crear distribuciones</li>
</ol>
  <form class="form" action="{{ url('distribuciones') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="col-md-12">
        <center> <h4 class="box-title">Alcance: proceso de distribución</h4> </center>
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
                <select class="form-control" name="distribucion[descripcion_dis][]">
                  <option value="">Seleccione...</option>
                  <option value="Inspeccion retie proceso de distribución en MT">Inspeccion retie proceso de distribución en MT</option>
                  <option value="Inspeccion retie proceso de distribución en BT">Inspeccion retie proceso de distribución en BT</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Tipo</label></center>
                <select class="form-control" name="distribucion[tipo_dis][]">
                  <option value="">Seleccione...</option>
                  <option value="aerea">tipo Aerea</option>
                  <option value="subterranea">tipo subterranea</option>
                  <option value="aerea/subterranea">Aerea/Subterranea</option>
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

            <div class="col-md-1" id="tblprod3" >
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>

          </div>
        </div>
        <button type="submit" id="submit" class="btn btn-primary pull-right">
          Guardar
        </button>
      </div>
    </div>
  </form>
@endsection
