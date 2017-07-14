<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3>Alcance: proceso de uso final</h3> </center>
  </div>
  <div class="box-body">
    <form class="form1" action="<?php echo e(url('editarpu')); ?>" method="post">
      <?php echo e(csrf_field()); ?>


    <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input type="hidden" name="pu_final[id][]" value="<?php echo e($pu->id); ?>">
      <div class="row quitar52" id="quitar52">
        <div class="col-md-12">
          <center> <h3>Alcance: proceso de uso final</h3> </center>
        </div>
        <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <input type="hidden"  name="pu[id][]" value="<?php echo e($pu->id); ?>" >
            <center><label >Descripción</label></center>
            <select class="form-control desc3"name="pu_final[descripcion_pu][]" style="width:100%" id="instalacion">
              <option value="<?php echo e($pu->descripcion); ?>"><?php echo e($pu->descripcion); ?></option>
              <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
              <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
              <option value="Inspección RETIE proceso uso industrial">Inspección RETIE proceso uso industrial</option>

            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">
              <option value="<?php echo e($pu->tipo); ?>"><?php echo e($pu->tipo); ?></option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Estrato</label></center>
            <select class="form-control"name="pu_final[estrato_pu][]" style="width:100%">
              <option value="<?php echo e($pu->estrato); ?>"><?php echo e($pu->estrato); ?></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad3" value="<?php echo e($pu->cantidad); ?>" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >m²</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" value="<?php echo e($pu->metros); ?>" name="pu_final[metros_pu][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >KVA</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" value="<?php echo e($pu->kva); ?>" name="pu_final[kva_pu][]">
          </div>
        </div>
        <div class="box-footer">
          <a href="<?php echo e(url('deletepu')); ?>/<?php echo e($pu->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>

        </div>
      </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="box-footer">
      <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
    </div>
    </form>
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
 -->

<!-- </script> -->
