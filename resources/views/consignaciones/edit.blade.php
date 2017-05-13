@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar consignaciones</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Consignaciones</h3> </center>
    </div>
    <div class="box-body">

      @foreach($consignaciones as $consignacion)
      {!! Form::model($consignacion, ['method' => 'PATCH', 'action' => ['ConsignacionController@update',$consignacion->id]]) !!}
      {{ csrf_field() }}
<input type="hidden" name="id" value="{{$consignacion->id}}">
        <div class="box-body col-md-6">
          <div class="box-body col-md-6">
            <br>

            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor', 'Valor') !!}
              {!! Form::text('valor', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
              {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

        </div>

        <div class="box-footer">
          <a href="{{ url('deleteconsignacion') }}/{{ $consignacion->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
@endsection
