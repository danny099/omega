@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar Otro si</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <center> <h3 class="box-title">Otro si</h3> </center>
      </div>
      <div class="box-body">

        @foreach($otrosi as $key => $otro)
        {!! Form::model($otro, ['method' => 'PATCH', 'action' => ['OtrosiController@update',$otro->id]]) !!}
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $otro->id}}">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="form-group">
                {!! Form::number('valor',null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>
            </div>
            <div class="box-footer">
              <a href="{{ url('deleteotrosi') }}/{{ $otro->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
              <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
            </div>
          </div>

        </div>
        {!! Form::close() !!}
        @endforeach
  </div>
@endsection
