<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 > Editar cuentas de cobro</h3> </center>
  </div>
  <div class="box-body">
      <form class="form1" action="<?php echo e(url('editarcobros')); ?>" method="post">
        <?php echo e(csrf_field()); ?>


      <?php $__currentLoopData = $cuenta_cobros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input type="hidden" name="cuenta[id][]" value="<?php echo e($cuenta->id); ?>">
      <input type="hidden" name="cuenta[administrativa_id][]" value="<?php echo e($cuenta->administrativa_id); ?>">

        <div class="box-body col-md-12">

            <br>
            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('porcentaje', 'Porcentaje:'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="numbe" name="cuenta[porcentaje][]" onkeyup="mascara(this,cpf)" class="form-control" required="" value="<?php echo e($cuenta->porcentaje); ?>">
                <!-- <?php echo Form::number('cuenta[porcentaje][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0','placeholder'=>'%']); ?> -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('valor', 'Valor:'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" min="0" class="form-control" required="" name="cuenta[valor][]" onkeyup="mascara(this,cpf)" value="<?php echo e(number_format($cuenta->valor,0)); ?>">
                <!-- <?php echo Form::number('cuenta[valor][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']); ?> -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('fecha_cuenta_cobro', 'Fecha cuenta de cobro:'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="cuenta[fecha_cuenta_cobro][]" required="" class="form-control" value="<?php echo e($cuenta->fecha_cuenta_cobro); ?>">
                <!-- <?php echo Form::date('cuenta[fecha_cuenta_cobro][]', null, ['class' => 'form-control' , 'required' => 'required']); ?> -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('fecha_pago', 'Fecha de pago:'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="date" name="cuenta[fecha_pago][]" class="form-control" required=""  value="<?php echo e($cuenta->fecha_pago); ?>">
                <!-- <?php echo Form::date('cuenta[fecha_pago][]', null, ['class' => 'form-control' , 'required' => 'required']); ?> -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('numero_cuenta_cobro', 'Número cuenta de cobro:'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="number" name="cuenta[numero_cuenta_cobro][]" required="" class="form-control" value="<?php echo e($cuenta->numero_cuenta_cobro); ?>">
                <!-- <?php echo Form::number('cuenta[numero_cuenta_cobro][]', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0']); ?> -->
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <?php echo Form::label('observaciones', 'Observaciones'); ?>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="cuenta[observaciones][]" required="" class="form-control" value="<?php echo e($cuenta->observaciones); ?>">
                <!-- <?php echo Form::text('cuenta[observaciones][]', null, ['class' => 'form-control' , 'required' => 'required'] ); ?> -->
              </div>
            </div>

        </div>

        <div class="box-footer">
          <a href="<?php echo e(url('deletecuenta')); ?>/<?php echo e($cuenta->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
    </form>
    </div>
  </div>
