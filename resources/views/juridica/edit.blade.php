@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('clientes') }}">Cliente</a></li>
    <li class="active">Editar persona juridcia</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar persona juridica</h3>
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
        {!! Form::model($juridica, ['method' => 'PATCH', 'action' => ['JuridicaController@update',$juridica->id]]) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>

          <div class="form-group">
            {!! Form::label('razon_social', 'Razon social') !!}
            {!! Form::text('razon_social', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nit', 'Nit') !!}
            {!! Form::number('nit', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nombre_representante', 'Nombre representante') !!}
            {!! Form::text('nombre_representante', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cedula', 'Cedula') !!}
            {!! Form::number('cedula', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>




        </div>
        <div class="box-body col-md-6">
          <br>


            <div class="form-group">
              {!! Form::label('direccion', 'Direccion') !!}
              {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('telefono', 'Telefono') !!}
              {!! Form::number('telefono', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('email', 'Email') !!}
              {!! Form::email('email', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection
