@extends('index')

@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Editar Proyecto</li>
</ol>
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3> </center>
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
  {!! Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]) !!}
  {{ csrf_field() }}

    <div class="box-body">
      <div class="col-md-4">

        @if($administrativas->codigo_proyecto != null)
          <div class="form-group">
            {!! Form::label('codigo', 'Codigo del proyecto:') !!}
            {!! Form::text('codigo', $administrativas->codigo_proyecto, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        @else
          <div class="form-group">
            {!! Form::label('codigo', 'Codigo del proyecto:') !!}
            {!! Form::text('codigo', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        @endif

        @if($administrativas->nombre_proyecto != null)
          <div class="form-group">
            {!! Form::label('nombre', 'Nombre del proyecto') !!}
            {!! Form::text('nombre', $administrativas->nombre_proyecto, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        @else
          <div class="form-group">
            {!! Form::label('nombre', 'Nombre del proyecto') !!}
            {!! Form::text('nombre',null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        @endif

        @if($administrativas->fecha_contrato != null)
        <div class="form-group">
          {!! Form::label('fecha', 'Fecha del contrato:') !!}
          {!! Form::date('fecha', $administrativas->fecha_contrato, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
        @else
          <div class="form-group">
            {!! Form::label('fecha', 'Fecha del contrato:') !!}
            {!! Form::date('fecha',null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        @endif



      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Departamento</label>
            <select class="form-control" name="departamento" id="departamento">
              <option value="">{{ $administrativas->departamento->nombre }}</option>
              @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
          <label >Municipios</label>
            <select class="form-control" name="municipio" id="municipio">
              <option value="">{{ $municipio->nombre }}</option>
              <option value=""></option>
            </select>
        </div>
        <div class="form-group">
          <label >Tipo de zona</label>
          <select class="form-control" name="zona">
            <option value="">{{ $administrativas->tipo_zona }}</option>
          </select>
        </div>

      </div>


      <hr>

</div>
</div>

@endsection
