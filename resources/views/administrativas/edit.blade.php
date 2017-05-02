@extends('index')

@section('contenido')

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
        <div class="form-group">
          <label >Cliente</label>
          <select class="form-control" name="cliente_id">
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>

      </div>

      <div class="col-md-4">
        <div class="form-group">
          {!! Form::label('propietario', 'Propietario:') !!}
          {!! Form::text('propietario', $administrativas->propietario, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>

        <div class="form-group">
          <label >Departamento</label>
          <select class="form-control" name="departamento">
          </select>
        </div>
        <div class="form-group">
          <label >Ciudad</label>
          <select class="form-control" name="municipio">

          </select>
        </div>
        <div class="form-group">
          <label >Tipo de zona</label>
          <select class="form-control" name="zona">

          </select>
        </div>
      </div>

      <div class="col-md-4">

        <div class="form-group">

          {!! Form::label('contrato_inicial', 'Valor contrato inicial:') !!}
          {!! Form::text('contrato_inicial', $administrativas->valor_contrato_inicial, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
        {!! Form::label('otrosi', 'Otro si:') !!}
        <div class="form-group ">
          <div class="col-md-11">
            {!! Form::number('otrosi',$administrativas->otrosi->valor, ['class' => 'form-control' ]) !!}
          </div>
          <div class="col-md-1">
            <a class="btn btn-warning" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
          <div class="form-group">
            <br>
            <br>
            {!! Form::label('contrato_final', 'Valor contrato final:') !!}
            {!! Form::number('contrato_final', $administrativas->valor_contrato_final, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('plan_pago', 'Plan de pagos:') !!}
            {!! Form::number('plan_pago',$administrativas->plan_pago, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        </div>
      </div>
      <hr>

</div>
</div>


<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
  </div>

    <div class="box-body">
      <div class="col-md-3">
        <div class="form-group">
          <center>{!! Form::label('descripcion', 'Descripcion') !!}</center>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="descripcion">
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="tipo">
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
            <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_transformacion">
          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label >{!! Form::label('cantidad', 'Cantidad') !!}</label></center>
          {!! Form::number('cantidad', $administrativas->transformacion->cantidad, ['class' => 'form-control' ]) !!}
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>

      <div class="col-md-12">
        <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripcion</label></center>
        </div>
        <div class="form-group">
          <select class="form-control" name="descripcion_dis">

            <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
            <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="tipo_dis">

            <option value="aerea">tipo Aerea</option>
            <option value="subterranea">tipo subterranea</option>

          </select>
        </div>
      </div>



      <div class="col-md-1">
        <div class="form-group">
          <center>{!! Form::label('plan_pago', 'Unidad') !!}</center>
          <center>
            <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_distribucion">

          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center>{!! Form::label('cantidad_dis', 'Cantidad') !!}</center>
          {!! Form::text('cantidad_dis',  $administrativas->distribucion->cantidad, ['class' => 'form-control' ]) !!}
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>

      <div class="col-md-12">
        <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripcion</label></center>
        </div>
        <div class="form-group">
          <select class="form-control"name="descripcion_pu">

            <option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option>
            <option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option>

          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="tipo_pu">

            <option value="Casa">Casa</option>
            <option value="Apartamentos">Apartamentos</option>
            <option value="Zona comun">Zona comun</option>
            <option value="Local comercial">Local comercial</option>
            <option value="Punto fijo">Punto fijo</option>

          </select>
        </div>
      </div>


      <div class="col-md-1">
        <div class="form-group">
          <center>{!! Form::label('unidad_pu_final', 'Unidad') !!}</center>
          <center>
            <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_pu_final">
          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center>{!! Form::label('cantidad_pu', 'Cantidad') !!}</center>
          {!! Form::text('cantidad_pu', $administrativas->pu_final->cantidad, ['class' => 'form-control' ]) !!}
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>

      <div class="col-md-12">
        <center> <h4 class="box-title">Resumen de estado administrativo del proyecto</h4> </center>
      </div>

      <div class="col-md-12">
        <textarea  rows="4" cols="250" name="resumen" value="{{ $administrativas->resumen}}">{{ $administrativas->resumen}}</textarea>
      </div>
    </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>


@endsection
