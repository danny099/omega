@extends('index')
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li class="active">Crear adicionales</li>
</ol>
  <form class="" action="{{ url('adicionales') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="col-md-12">
        <center> <h4 class="box-title">Valor adicional</h4> </center>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Codigo Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select">
                  <option value="">Seleccione..</option>
                  @foreach($codigos as $codigo)
                  <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <center><label >Valor adicional</label></center>
                <input type="text" class="form-control" placeholder= "Valor" name="adicional[valor][]">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <center><label >Detalle</label></center>
                <input type="text" class="form-control" placeholder= "Detalle" name="adicional[detalle][]">
              </div>
            </div>

            <div class="col-md-1" id="tblprod5" >
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" id="btnadd5" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
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
