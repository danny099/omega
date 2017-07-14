<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $__currentLoopData = $otrosis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otrosi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="container">
        <div class="col-md-3 well">
          <?php echo e($otrosi->id); ?>

          <br>
          <?php echo e($otrosi->valor); ?>

        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </body>
</html>
