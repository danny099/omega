<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transformacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="container">
        <div class="col-md-3 well">
          <?php echo e($transformacion->id); ?>

          <br>
          <?php echo e($transformacion->tipo_transformacion); ?>

          <br>
          <?php echo e($transformacion->tipo_poste); ?>

          <br>
          <?php echo e($transformacion->unidad); ?>

          <br>
          <?php echo e($transformacion->cantidad); ?>

        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html>
