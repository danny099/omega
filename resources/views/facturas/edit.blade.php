
<div class="container">
  <div class="">
    <div class="">
      <h3 class="box-title">Editar facturas</h3>
    </div>


    {!! Form::model($factura, ['class' => 'form1','method' => 'PATCH', 'action' => ['FacturaController@update',$factura->id]]) !!}
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$factura->id}}">
    <div class="box-body col-md-6">
      <br>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('codigo_factura', 'Numero de la factura') !!}
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
          {!! Form::label('valor_factura', 'Valor factura antes de IVA') !!}
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
          {!! Form::label('retenciones', 'Retenciones %') !!}<br>
          {!! Form::label('retenciones2', 'Retenciones valor') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('retencionesporcen',  0, ['class' => 'form-control retencionesporcen', 'min'=>'0']) !!}
          {!! Form::text('retenciones', 0, ['class' => 'form-control retenciones', 'min'=>'0','readonly']) !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('amortizacion2', 'Amortización valor:') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('amortizacion', 0, ['class' => 'form-control amortizacion', 'min'=>'0','onkeypress'=>"mascara(this,cpf)"]) !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('polizas2', 'Pólizas valor:') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('polizas', 0, ['class' => 'form-control polizas','min'=>'0','onkeypress'=>"mascara(this,cpf)" ]) !!}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('retegarantia', 'Retegarantía%:') !!}
          {!! Form::label('retegarantia2', 'Retegarantía valor:') !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::text('retegarantiaporcen', 0, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]) !!}
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
          {!! Form::text('valor_pagado',  number_format($factura->valor_total,0), ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]) !!}
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
      <div class="col-md-6">
        <div class="form-group">
           <center><label>Recordarme</label></center>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="radio" name="recor_fac" value="1" required> Si<br>
          <input type="radio" name="recor_fac" value="0"> No<br>
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
