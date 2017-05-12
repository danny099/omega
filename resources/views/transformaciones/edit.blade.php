@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar transformaciones</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
    </div>
    <div class="box-body">

      @foreach($transformaciones as $transfor)
      {!! Form::model($transfor, ['method' => 'PATCH', 'action' => ['TransformacionController@update',$transfor->id]]) !!}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $transfor->id}}">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripcion</label></center>
            <input type="text" class="form-control" value="{{ $transfor->descripcion }}"  readonly=”readonly” name="descripcion">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="tipo">
              <option value="{{ $transfor->tipo }}">{{ $transfor->tipo }}</option>
              <option value="tipo_poste">tipo poste</option>
              <option value="tipo_interior">tipo interior</option>
              <option value="tipo_exterior">tipo exterior</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Capacidad</label></center>
            <select class="form-control" name="capacidad">
              <option value="{{ $transfor->capacidad }}">{{ $transfor->capacidad }}</option>
              <option value="5KVA">5KVA</option>
              <option value="10KVA">10KVA</option>
              <option value="15KVA">15KVA</option>
              <option value="150KVA">150KVA</option>
            </select>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center><label>Unidad</label></center>
            <center>
              <input style="text-align:center;" type="text" class="form-control" value="{{ $transfor->unidad }}"  readonly=”readonly” name="unidad_transformacion">
            </center>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad" value="{{ $transfor->cantidad }}">
          </div>
        </div>

        <div class="box-footer">
          <a href="{{ url('deletetransfor') }}/{{ $transfor->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
@endsection
