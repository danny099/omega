@extends('index')

@section('contenido')
  <form class="" action="{{ url('otrosi') }}" method="post">
    {{ csrf_field() }}
    <div class="container">
      <div class="box box-primary">
        <div class="box-header with-borde">
          <center> <h3 class="box-title">Agregar Otro si</h3> </center>
        </div>
        <div class="">
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
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
              <br>
              <div class="col-md-6">
                <div class="form-group ">
                    <div class="col-md-6">
                      <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar2()" >
                    </div>
                    <div class="col-md-1" id="tblprod">
                      <a class="btn btn-warning" id="btnadd" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary pull-right">
                Guardar
              </button>
            </div>  
          </div>
        </div>
    </div>
  </form>
@endsection
