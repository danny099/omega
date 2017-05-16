@extends('index')

@section('contenido')
  <form class="" action="{{ url('otrosi') }}" method="post">
    {{ csrf_field() }}
    <div class="container">
      <div class="box box-primary">
        <div class="box-header with-borde">
          <center> <h2 class="box-title">Agregar Otro si</h2> </center>
        </div>
        <div class="">
          <div class="box-body">

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <center><label >Codigo Proyecto</label></center>
                  </div>
                </div>
                <div class="form-group ">
                    <div class="col-md-4">
                      <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select" required="">
                        <option value="">Seleccione..</option>
                        @foreach($codigos as $codigo)
                        <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4" id="tblprod">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <center><label >valor antes de iva</label></center>
                  </div>
                  <div class="form-group ">
                      <div class="col-md-4">
                        <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar2()" >
                      </div>
                      <div class="col-md-4" id="tblprod">
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
