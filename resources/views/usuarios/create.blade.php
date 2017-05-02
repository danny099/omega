@extends('index')

@section('contenido')

  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Crear Usuario</h3>
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
        {!! Form::open(['url' => 'usuarios']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>


          <div class="form-group">
            {!! Form::label('cedula', 'Cedula') !!}
            {!! Form::number('cedula', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nombres', 'Nombres') !!}
            {!! Form::text('nombres', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('apellidos', 'Apellidos') !!}
            {!! Form::text('apellidos', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>


        </div>
        <div class="box-body col-md-6">
          <br>

          <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::text('password', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <br>
          <br>

          <div class="form-group">
            {!! Form::label('rol_id', 'Rol') !!}
            {!! Form::select('rol_id',$roles,['class' => 'form-control','required' => 'required']) !!}
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
