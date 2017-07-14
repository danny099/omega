
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 > Editar consignaiones</h3> </center>
  </div>
  <div class="box-body">
      <form class="" action="<?php echo e(url('editarconsignacion')); ?>" method="post">
        <?php echo e(csrf_field()); ?>


      <?php $__currentLoopData = $consignaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consignacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php echo e(csrf_field()); ?>

      <input type="hidden" name="consignacion[id][]" value="<?php echo e($consignacion->id); ?>">
      <input type="hidden" name="consignacion[administrativa_id][]" value="<?php echo e($consignacion->administrativa_id); ?>">
        <div class="box-body col-md-12">

          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('fecha_pago', 'Fecha de pago'); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="date" name="consignacion[fecha_pago][]" class="form-control" required="" value="<?php echo e($consignacion->fecha_pago); ?>">
              <!-- <?php echo Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']); ?> -->
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('valor', 'Valor antes de IVA'); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[valor][]" class="form-control valor" onkeyup="mascara(this,cpf)" required="" value="<?php echo e(number_format($consignacion->valor,0)); ?>">
              <!-- <?php echo Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0']); ?> -->
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('iva', 'IVA'); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[valor_iva][]" class="form-control iva"  readonly="" value="<?php echo e(number_format($consignacion->valor_iva,0)); ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('valor_total', 'Valor total'); ?>


            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[valor_total][]" class="form-control valor_total"  readonly="" value="<?php echo e(number_format($consignacion->valor_total,0)); ?>">

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php echo Form::label('observaciones', 'Observaciones'); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[observaciones][]" class="form-control" required="" value="<?php echo e($consignacion->observaciones); ?>">
              <!-- <?php echo Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']); ?> -->
            </div>
          </div>

          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>

        <div class="box-footer">
          <a href="<?php echo e(url('deleteconsignacion')); ?>/<?php echo e($consignacion->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
        </div>

      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
      </form>
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
              alert('Valor adicional editado');
              $('.modal').modal('hide');
            }
        })
        return false;
    });
  });
</script> -->
