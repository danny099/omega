<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $__currentLoopData = $administrativas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $administrativa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="container">
        <div class="col-md-3 well">
          <?php echo e($administrativa->id); ?>

          <br>
          <?php echo e($administrativa->codigo_proyecto); ?>

          <br>
          <?php echo e($administrativa->nombre_proyecto); ?>

          <br>
          <?php echo e($administrativa->fecha_contrato); ?>

          <br>
          <?php echo e($administrativa->cliente->nombre); ?>


        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html>
