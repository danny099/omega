<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 > Editar cuentas de cobro</h3> </center>
  </div>
  <div class="box-body">
      <form class="form1" action="{{ url('editarcobros') }}" method="post">
        {{ csrf_field() }}

      @foreach($cuenta_cobros as $cuenta)
      <input type="hidden" name="cuenta[id][]" value="{{ $cuenta->id }}">
      <input type="hidden" name="cuenta[administrativa_id][]" value="{{$cuenta->administrativa_id}}">

        <div class="box-body col-md-12">

            <br>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('porcentaje', 'Porcentaje:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="numbe" name="cuenta[porcentaje][]" onkeyup="mascara(this,cpf)" class="form-control" required="" value="{{$cuenta->porcentaje}}">
                <!-- {!! Form::number('cuenta[porcentaje][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0','placeholder'=>'%']) !!} -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('valor', 'Valor:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" min="0" class="form-control" required="" name="cuenta[valor][]" onkeyup="mascara(this,cpf)" value="{{ number_format($cuenta->valor,0) }}">
                <!-- {!! Form::number('cuenta[valor][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']) !!} -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('fecha_cuenta_cobro', 'Fecha cuenta de cobro:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="cuenta[fecha_cuenta_cobro][]" required="" class="form-control" value="{{ $cuenta->fecha_cuenta_cobro }}">
                <!-- {!! Form::date('cuenta[fecha_cuenta_cobro][]', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('fecha_pago', 'Fecha de pago:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="cuenta[fecha_pago][]" class="form-control" required=""  value="{{ $cuenta->fecha_pago }}">
                <!-- {!! Form::date('cuenta[fecha_pago][]', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('numero_cuenta_cobro', 'Número cuenta de cobro:') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="number" name="cuenta[numero_cuenta_cobro][]" required="" class="form-control" value="{{ $cuenta->numero_cuenta_cobro }}">
                <!-- {!! Form::number('cuenta[numero_cuenta_cobro][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']) !!} -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('observaciones', 'Observaciones') !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="cuenta[observaciones][]" required="" class="form-control" value="{{ $cuenta->observaciones}}">
                <!-- {!! Form::text('cuenta[observaciones][]', null, ['class' => 'form-control' , 'required' => 'required'] ) !!} -->
              </div>
            </div>

        </div>

        <div class="box-footer">
          <a href="{{ url('deletecuenta') }}/{{ $cuenta->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
        </div>
      </div>
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
    </form>
    </div>
  </div>
