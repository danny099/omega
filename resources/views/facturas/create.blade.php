


  <div class="container">
    <div class="">
      <div class="">
        <h3 class="box-title">Crear Facturas</h3>
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
              {!! Form::label('fecha_factura', 'Fecha de la factura') !!}
              {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor_factura', 'Valor factura antes de iva') !!}
              {!! Form::number('valor_factura', null, ['class' => 'form-control valor_factura' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('iva', 'IVA') !!}
              {!! Form::number('iva', null, ['class' => 'form-control iva' ,'readonly', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor_total', 'Valor total de la factura') !!}
              {!! Form::number('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('retenciones', 'Retenciones') !!}
              {!! Form::number('retenciones', 0, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('amortizacion', 'Amortizacion:') !!}
              {!! Form::number('amortizacion', 0, ['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('polizas', 'Polizas:') !!}
              {!! Form::number('polizas', 0, ['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('retegarantia', 'Retegarantia:') !!}
              {!! Form::number('retegarantia', 0, ['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor_pagado', 'Valor pagado:') !!}
              {!! Form::number('valor_pagado', 0, ['class' => 'form-control' ]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones:') !!}
              {!! Form::text('observaciones', null, ['class' => 'form-control' ]) !!}
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
