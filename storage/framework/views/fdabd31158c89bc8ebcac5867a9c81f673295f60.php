<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="container">
        <div class="col-md-3 well">
          <?php echo e($distribucion->id); ?>

          <br>
          <?php echo e($distribucion->tipo_distribucion); ?>

          <br>
          <?php echo e($distribucion->tipo_red); ?>

          <br>
          <?php echo e($distribucion->unidad); ?>

          <br>
          <?php echo e($distribucion->cantidad); ?>

        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html>
