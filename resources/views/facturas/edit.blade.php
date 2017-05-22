
<div class="container">
  <div class="">
    <div class="">
      <h3 class="box-title">Editar facturas</h3>
    </div>


    {!! Form::model($factura, ['class' => 'form1','method' => 'PATCH', 'action' => ['FacturaController@update',$factura->id]]) !!}
    {{ csrf_field() }}
    <!-- <input type="hidden" name="id" value="{{$factura->id}}"> -->
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
          {!! Form::text('valor_factura',  number_format($factura->valor_factura,0), ['class' => 'form-control valor_factura' ,'required' => 'required', 'min'=>'0','onkeypress'=>"mascara(this,cpf)"]) !!}

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('iva', 'IVA') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('iva', number_format($factura->iva,0), ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('valor_total', 'Valor total de la factura') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('valor_total',  number_format($factura->valor_total,0), ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
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
          {!! Form::number('retencionesporcen',  0, ['class' => 'form-control retencionesporcen', 'min'=>'0']) !!}
          {!! Form::text('retenciones', 0, ['class' => 'form-control retenciones', 'min'=>'0','readonly']) !!}
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
          {!! Form::number('amortizacionporcen', 0, ['class' => 'form-control amortizacionporcen', 'min'=>'0']) !!}
          {!! Form::text('amortizacion', 0, ['class' => 'form-control amortizacion', 'min'=>'0','readonly']) !!}
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
          {!! Form::number('polizasporcen', 0, ['class' => 'form-control polizasporcen','min'=>'0' ]) !!}
          {!! Form::text('polizas', 0, ['class' => 'form-control polizas','min'=>'0','readonly' ]) !!}
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
          {!! Form::number('retegarantiaporcen', 0, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]) !!}
          {!! Form::text('retegarantia', 0, ['class' => 'form-control retegarantia', 'min'=>'0','readonly' ]) !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('valor_pagado', 'Valor pagado:') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('valor_pagado',  number_format($factura->valor_pagado,0), ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]) !!}
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
            <button type="submit"  data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
          </div>
    </div>
    {!! Form::close() !!}

  </div>
</div>

<!-- <script>
  $(document).ready(function() {

  // Interceptamos el evento submit
  $('.form1').on('submit',function() {
// Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
          // Mostramos un mensaje con la respuesta de PHP
            success: function() {
              alert('Alcance de distribucion editado');
              $('.modal').modal('hide');
            }
        })
        return false;
    });
  });

</script> -->
