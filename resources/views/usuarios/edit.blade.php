@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
    <li class="active">Editar Usuario</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar Usuario</h3>
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
        {!! Form::model($usuarios, ['method' => 'PATCH', 'action' => ['UsuarioController@update',$usuarios->id]]) !!}
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
          <br>
          <br>
          <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::password('password', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            <span id="show-pass" class="glyphicon glyphicon-eye-open"></span>

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
          <button type="submit" class="btn btn-primary pull-right">Enviar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection

@section('scripts')

  <script type="text/javascript">
  $(document).ready(function () {
     $('#show-pass').click(function () {
      if ($('#password').attr('type') === 'text') {
       $('#password').attr('type', 'password');
      } else {
       $('#password').attr('type', 'text');
      }
     });
    });
  </script>

@endsection
