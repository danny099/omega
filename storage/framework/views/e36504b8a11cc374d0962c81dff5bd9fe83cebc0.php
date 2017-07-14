<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu_final): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="container">
        <div class="col-md-3 well">
          <?php echo e($pu_final->id); ?>

          <br>
          <?php echo e($pu_final->tipo_retie); ?>

          <br>
          <?php echo e($pu_final->tipo_residencial); ?>

          <br>
          <?php echo e($pu_final->unidad); ?>

          <br>
          <?php echo e($pu_final->cantidad); ?>

        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html>
