@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('ncObra') }}">Reporte de no conformidades</a></li>
    <li class="active">Crear reporte de no conformidades</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Crear reporte de no conformidades</h3>
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
        <div class="row">
          <form class="" action="index.html" method="post">
            <div class="col-md-12">
              <div class="col-md-3">
                <p>Informe de No conformidades de Obra N.1</p>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <center><label >NC1</label></center>
                  <input type="text" name="" value="">
                </div>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-primary " style="background-color: #33579A; border-color:#33579A;" name="button">agregar fila</button>
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-primary " style="background-color: #33579A; border-color:#33579A;" name="button">agregar NC</button>


              </div>
            </div>

          </form>
        </div>
        <!-- /.box-body -->



    </div>
  </div>

@endsection

@section('scripts')


@endsection
