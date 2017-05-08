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

          <div class="form-group">
            {!! Form::label('codigo', 'Codigo del proyecto:') !!}
            {!! Form::text('codigo', $administrativas->codigo_proyecto, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('nombre', 'Nombre del proyecto') !!}
            {!! Form::text('nombre', $administrativas->nombre_proyecto, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

        <div class="form-group">
          {!! Form::label('fecha', 'Fecha del contrato:') !!}
          {!! Form::date('fecha', $administrativas->fecha_contrato, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>

        <div class="form-group" >
          <label >Tipo cliente</label>
          <select class="form-control" name="cliente_id" id="cliente" required="">
            <option value="">Seleccione</option>
            <option value="1">Persona narural</option>
            <option value="2">Persona juridica</option>
          </select>
        </div>

        <div class="form-group" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="Display:none" id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" >
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>


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
        <div class="form-group">
          {!! Form::label('valor_contrato_inicial', 'Valor antes del iva') !!}
          {!! Form::number('valor_contrato_inicial', $administrativas->valor_contrato_inicial, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label >Valor iva</label>
          <input type="number" class="form-control" id="iva" readonly="readonly" placeholder= "valor iva" name="iva" value="">
        </div>
        <label >Valor adicional</label>
        <div class="form-group ">
          <div class="col-md-11" >
            <input type="number" class="form-control" id="adicional" placeholder= "Ingrese valor" name="adicional[]"  onkeyup="sumar()" >
            <label >detalle valor adicional</label>
            <input type="text" class="form-control" id="detalle" placeholder= "Ingrese detalle" name="detalle[]"  >
          </div>

          <div class="col-md-1" id="tblprod5">
            <a class="btn btn-warning" id="btnadd5" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>

        <label >Otro si</label>
        <div class="form-group ">
          <div class="col-md-11" >
            <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar()" >
          </div>

          <div class="col-md-1" id="tblprod">
            <a class="btn btn-warning" id="btnadd" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>


          <div class="form-group">
            <br>
            <br>
            <label >Valor contrato final</label>
            <input type="number" class="form-control" id="fin" readonly="readonly" placeholder= "Valor final" name="contrato_final"   >
          </div>

          <div class="form-group">
            <label >Plan de pago</label>
            <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago">
          </div>
        </div>

      </div>


      <hr>

</div>
</div>

@endsection
