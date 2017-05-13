@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar Cuentas de cobro</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Cuentas de cobro</h3> </center>
    </div>
    <div class="box-body">

      @foreach($cuentas as $cuenta)
      {!! Form::model($cuenta, ['method' => 'PATCH', 'action' => ['Cuenta_cobroController@update',$cuenta->id]]) !!}
      {{ csrf_field() }}
<input type="hidden" name="id" value="{{$cuenta->id}}">
        <div class="box-body col-md-6">
          <div class="box-body col-md-6">
            <br>


              <div class="form-group">
                {!! Form::label('porcentaje', 'Porcentaje:') !!}
                {!! Form::number('porcentaje', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('valor', 'Valor:') !!}
                {!! Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('fecha_cuenta_cobro', 'Fecha cuenta de cobro:') !!}
                {!! Form::date('fecha_cuenta_cobro', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('fecha_pago', 'Fecha de pago:') !!}
                {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('numero_cuenta_cobro', 'Numero cuenta de cobro:') !!}
                {!! Form::number('numero_cuenta_cobro', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

              <div class="form-group">
                {!! Form::label('observaciones', 'Observaciones') !!}
                {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>

        </div>

        <div class="box-footer">
          <a href="{{ url('deletecuenta') }}/{{ $cuenta->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
@endsection
