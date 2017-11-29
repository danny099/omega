@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('disDeta/disDeta') }}">Disello detallado</a></li>
    <li class="active">Crear Disello detallado</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Crear disello detallado</h3>
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
          <form class="" action="" method="post">
            <div class="col-md-12">
              <div class="col-md-6">
                <label>Items</label>

              </div>
              <div class="col-md-1">
                <label>Aplica</label>

              </div>
              <div class="col-md-1">
                <label >Cumple</label>

              </div>
              <div class="col-md-4" >
                <label >Observaciones</label>
              </div>
            </div>

            @foreach($items as $item)
              <div class="col-md-12">
                <div class="col-md-6">
                  <p>{{$item->item}}</p>

                </div>
                <div class="col-md-1">
                  <label class="radio-inline"><input type="radio" name="aplica">Si</label>
                  <label class="radio-inline"><input type="radio" name="aplica">No</label>

                </div>
                <div class="col-md-1">
                  <label class="radio-inline"><input type="radio" name="cumple">Si</label>
                  <label class="radio-inline"><input type="radio" name="cumple">No</label>
                </div>
                <div class="col-md-4" >
                  <input type="text" class="form-control" name="observaciones">
                </div>
              </div>
            @endforeach
          </form>
        </div>
        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection

@section('scripts')


@endsection
