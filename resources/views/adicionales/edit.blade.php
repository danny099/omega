@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar Valor adicional</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Valor adicional</h3> </center>
    </div>
    <div class="box-body">

      @foreach($adicional as $adici)
      {!! Form::model($adici, ['method' => 'PATCH', 'action' => ['ValorAdicionalController@update',$adici->id]]) !!}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $adici->id}}">
      <div class="col-md-12">

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Valor adicional</label></center>
            <input type="text" class="form-control" placeholder= "Valor" name="valor" value="{{ $adici->valor }}">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <center><label >Detalle</label></center>
            <input type="text" class="form-control" placeholder= "Detalle" name="detalle" value="{{ $adici->detalle }}">
          </div>
        </div>

        <div class="box-footer">
          <a href="{{ url('deleteadicional') }}/{{ $adici->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
@endsection
