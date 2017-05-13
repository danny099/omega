@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar Facturas</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Facturas</h3> </center>
    </div>
    <div class="box-body">

      @foreach($facturas as $factura)
      {!! Form::model($factura, ['method' => 'PATCH', 'action' => ['FacturaController@update',$factura->id]]) !!}
      {{ csrf_field() }}
<input type="hidden" name="id" value="{{$factura->id}}">
        <div class="box-body col-md-6">
          <br>
          <div class="form-group">
            {!! Form::label('num_factura', 'Numero Factura') !!}
            {!! Form::number('num_factura', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('fecha_factura', 'Fecha de la factura') !!}
            {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('valor_factura', 'Valor factura antes de iva') !!}
            {!! Form::number('valor_factura', null, ['class' => 'form-control valor_factura' , 'required' => 'required', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('iva', 'IVA') !!}
            {!! Form::number('iva', null, ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('valor_total', 'Valor total de la factura') !!}
            {!! Form::number('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('retenciones', 'Retenciones') !!}
            {!! Form::number('retenciones', 0, ['class' => 'form-control', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('amortizacion', 'Amortizacion:') !!}
            {!! Form::number('amortizacion', 0, ['class' => 'form-control', 'min'=>'0']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('polizas', 'Polizas:') !!}
            {!! Form::number('polizas', 0, ['class' => 'form-control','min'=>'0' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('retegarantia', 'Retegarantia:') !!}
            {!! Form::number('retegarantia', 0, ['class' => 'form-control', 'min'=>'0' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('valor_pagado', 'Valor pagado:') !!}
            {!! Form::number('valor_pagado', 0, ['class' => 'form-control', 'min'=>'0' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
            {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('observaciones', 'Observaciones:') !!}
            {!! Form::text('observaciones', null, ['class' => 'form-control' ]) !!}
          </div>
        </div>

        <div class="box-footer">
          <a href="{{ url('deletefactura') }}/{{ $factura->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
@endsection
