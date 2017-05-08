


  <div class="container">
    <div class="">
      <div class="">
        <h3 class="box-title">Crear Clientes</h3>
      </div>


      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'facturas']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>
            <div class="form-group">
              {!! Form::label('num_factura', 'Numero Factura') !!}
              {!! Form::number('num_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fecha_factura', 'Fecha de pago') !!}
              {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor_factura', 'Valor Factura') !!}
              {!! Form::number('valor_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('iva', 'IVA') !!}
              {!! Form::number('iva', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('retenciones', 'Retenciones') !!}
              {!! Form::number('retenciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('amortizacion', 'Amortizacion:') !!}
              {!! Form::number('amortizacion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones:') !!}
              {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <input type="hidden" name="administrativa_id" value="{{ $administrativa->id }}">
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Enviar</button>
              <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left">Cancelar</button>
            </div>
        </div>

        <!-- /.box-body -->
      {!! Form::close() !!}
    </div>
  </div>
