
<div class="container">
  <div class="">
    <div class="">
      <h3 >Editar facturas</h3>
    </div>


    <?php echo Form::model($factura, ['class' => 'form1','method' => 'PATCH', 'action' => ['FacturaController@update',$factura->id],'autocomplete'=>"off"]); ?>

    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="id" value="<?php echo e($factura->id); ?>">
    <div class="box-body col-md-6">
      <br>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('codigo_factura', 'Número de la factura'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::number('num_factura', null, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('fecha_factura', 'Fecha de la factura'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required', 'style'=>'width:110%']); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('valor_factura', 'Valor factura antes de IVA'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('valor_factura',  number_format($factura->valor_factura,0), ['class' => 'form-control valor_factura' ,'required' => 'required', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]); ?>


        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('iva', 'IVA'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('iva', number_format($factura->iva,0), ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('valor_total', 'Valor total de la factura'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('valor_total',  number_format($factura->valor_total,0), ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('retenciones', 'Retenciones %'); ?><br>
          <?php echo Form::label('retenciones2', 'Retenciones valor'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('retencionesporcen',  $factura->rete_porcen, ['class' => 'form-control retencionesporcen', 'min'=>'0']); ?>

          <?php echo Form::text('retenciones', number_format($factura->retenciones,0), ['class' => 'form-control retenciones', 'min'=>'0','readonly']); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('amortizacion2', 'Amortización valor:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('amortizacion', number_format($factura->amortizacion,0), ['class' => 'form-control amortizacion', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('polizas2', 'Pólizas valor:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('polizas', number_format($factura->polizas,0), ['class' => 'form-control polizas','min'=>'0','onkeyup'=>"mascara(this,cpf)" ]); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('retegarantia', 'Retegarantía%:'); ?>

          <?php echo Form::label('retegarantia2', 'Retegarantía valor:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('retegarantiaporcen', $factura->retegaran_porcen, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]); ?>

          <?php echo Form::text('retegarantia', number_format($factura->retengarantia,0), ['class' => 'form-control retegarantia', 'min'=>'0','readonly' ]); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('valor_pagado', 'Valor pagado:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('valor_pagado',  number_format($factura->valor_pagado,0), ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::label('fecha_pago', 'Fecha Pago:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required', 'style'=>'width:110%']); ?>

        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('observaciones', 'Observaciones:'); ?>

        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <?php echo Form::text('observaciones', null, ['class' => 'form-control', 'required' => 'required' ]); ?>

        </div>
      </div>
      <div class="col-md-6" style="height:27px">
        <div class="form-group">
           <center><label>Recordarme</label></center>
        </div>
      </div>
      <div class="col-md-6">
        <label class="radio-inline">
          <input type="radio" name="recuerdame" value="1" required > Si
        </label>
        <label class="radio-inline">
          <input type="radio" name="recuerdame" value="0"> No
        </label>
      </div>
      <br>
      <br>

          <div class="box-footer">
            <button type="submit"  data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
          </div>
    </div>
    <?php echo Form::close(); ?>


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
