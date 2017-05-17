
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar consignaiones</h3> </center>
  </div>
  <div class="box-body">
      @foreach($consignaciones as $consignacion)
      {!! Form::model($consignacion, ['method' => 'PATCH', 'action' => ['ConsignacionController@update',$consignacion->id]]) !!}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$consignacion->id}}">
        <div class="box-body col-md-12">

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('valor', 'Valor') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>

        <div class="box-footer">
          <a href="{{ url('deleteconsignacion') }}/{{ $consignacion->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
        </div>
      </div>
    </div>
      {!! Form::close() !!}
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
    </div>
  </div>
