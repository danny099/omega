<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar cuentas de cobro</h3> </center>
  </div>
  <div class="box-body">
      @foreach($cuenta_cobros as $cuenta)
      {!! Form::model($cuenta, ['method' => 'PATCH', 'action' => ['Cuenta_cobroController@update',$cuenta->id]]) !!}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$cuenta->id}}">
        <div class="box-body col-md-12">

            <br>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('porcentaje', 'Porcentaje:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::number('porcentaje', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0','placeholder'=>'%']) !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('valor', 'Valor:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']) !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('fecha_cuenta_cobro', 'Fecha cuenta de cobro:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::date('fecha_cuenta_cobro', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('fecha_pago', 'Fecha de pago:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('numero_cuenta_cobro', 'Numero cuenta de cobro:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::number('numero_cuenta_cobro', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']) !!}
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

        </div>

        <div class="box-footer">
          <a href="{{ url('deletecuenta') }}/{{ $cuenta->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
        </div>
      </div>
      {!! Form::close() !!}
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
    </div>
  </div>
