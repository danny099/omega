@extends('index')
@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li><a href="javascript:history.back()">{{ $ide->nombre_proyecto }}</a></li>
    <li class="active">Editar distribuciones</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
    </div>
    <div class="box-body">
      @foreach($distribuciones as $distribucion)
        {!! Form::model($distribucion, ['method' => 'PATCH', 'action' => ['DistribucionController@update',$distribucion->id]]) !!}
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $distribucion->id}}">
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <center><label >Descripcion</label></center>
              <select class="form-control" name="descripcion">
                <option value="{{ $distribucion->descripcion }}">{{ $distribucion->descripcion }}</option>
                <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
                <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control" name="tipo">
                <option value="{{ $distribucion->tipo }}">{{ $distribucion->tipo }}</option>
                <option value="aerea">tipo Aerea</option>
                <option value="subterranea">tipo subterranea</option>
                <option value="aerea/subterranea">Aerea/Subterranea</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <center><label >Unidad</label></center>
              <center>
                <input type="text" class="form-control" value="km"  readonly=”readonly” name="unidad"style="text-align:center">
              </center>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              {!! Form::label('cantidad_dis', 'Cantidad') !!}
              {!! Form::text('cantidad', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              <!-- <center><label >Cantidad</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_dis" value="{{ $distribucion->cantidad }}"> -->
            </div>
          </div>

          <div class="box-footer">
            <a href="{{ url('deletedistri') }}/{{ $distribucion->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
            <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
          </div>
        </div>
        {!! Form::close() !!}
      @endforeach
    </div>
  </div>
@endsection
