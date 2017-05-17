  @foreach($facturas as $factura)
  <div class="container">
    <div class="">
      <div class="">
        <h3 class="box-title">Editar facturas</h3>
      </div>


      {!! Form::model($factura, ['method' => 'PATCH', 'action' => ['FacturaController@update',$factura->id]]) !!}
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$factura->id}}">
      <div class="box-body col-md-6">
        <br>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('codigo_factura', 'Codigo de la factura') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('num_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('fecha_factura', 'Fecha de la factura') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('valor_factura', 'Valor factura antes de iva') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('valor_factura', null, ['class' => 'form-control valor_factura' ,'required' => 'required', 'min'=>'0']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('iva', 'IVA') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('iva', null, ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('valor_total', 'Valor total de la factura') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('retenciones', 'Retenciones %') !!}
            {!! Form::label('retenciones2', 'Retenciones valor') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('retencionesporcen', null, ['class' => 'form-control retencionesporcen', 'min'=>'0']) !!}
            {!! Form::number('retenciones', null, ['class' => 'form-control retenciones', 'min'=>'0','readonly']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('amortizacion', 'Amortizacion%:') !!}
            {!! Form::label('amortizacion2', 'Amortizacion valor:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('amortizacionporcen', null, ['class' => 'form-control amortizacionporcen', 'min'=>'0']) !!}
            {!! Form::number('amortizacion', null, ['class' => 'form-control amortizacion', 'min'=>'0','readonly']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('polizas', 'Polizas%:') !!}<br>
            {!! Form::label('polizas2', 'Polizas valor:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('polizasporcen', null, ['class' => 'form-control polizasporcen','min'=>'0' ]) !!}
            {!! Form::number('polizas', null, ['class' => 'form-control polizas','min'=>'0','readonly' ]) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('retegarantia', 'Retegarantia%:') !!}
            {!! Form::label('retegarantia2', 'Retegarantia valor:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('retegarantiaporcen', null, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]) !!}
            {!! Form::number('retegarantia', null, ['class' => 'form-control retegarantia', 'min'=>'0','readonly' ]) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('valor_pagado', 'Valor pagado:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::number('valor_pagado', null, ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones:') !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {!! Form::text('observaciones', null, ['class' => 'form-control' ]) !!}
          </div>
        </div>

        <div class="box-footer">
          <a href="{{ url('deletefactura') }}/{{ $factura->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
          <button type="submit" data-target="" data-toggle="" class="glyphicon glyphicon-ok"></button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    </div>
      @endforeach
