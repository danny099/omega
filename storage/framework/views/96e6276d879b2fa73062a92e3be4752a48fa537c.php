<form action="<?php echo e(url('editaradicionales')); ?>" method="post" autocomplete="off">
  <?php echo e(csrf_field()); ?>

  <?php $__currentLoopData = $adicionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adici): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <input type="hidden" name="adicional[id][]" value="<?php echo e($adici->id); ?>">
  <div class="col-md-12">

    <div class="col-md-3">
      <div class="form-group">
        <center><label >Valor adicional</label></center>
        <input type="text" class="form-control" placeholder= "Valor" name="adicional[valor][]" onkeypress="mascara(this,cpf)" value="<?php echo e(number_format($adici->valor,0)); ?>">
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <center><label >Detalle</label></center>
        <input type="text" class="form-control" placeholder= "Detalle" name="adicional[detalle][]" value="<?php echo e($adici->detalle); ?>">
      </div>
    </div>

    <div class="box-footer">
      <a href="<?php echo e(url('deleteadicional')); ?>/<?php echo e($adici->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
    </div>
  </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <div class="box-footer">
    <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
  </div>
</form>
