
  <div class="box box-primary">

    <div class="box-body">
      <form class="form1" action="<?php echo e(url('editard')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

      <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row quitar51" id="quitar51">
          <input type="hidden" name="distribucion[id][]" value="<?php echo e($distribucion->id); ?>">
          <div class="col-md-12"  style="margin-bottom: 10px;">
            <center> <h3>Alcance: proceso de distribución</h3> </center>
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden"  name="distribucion[id][]" value="<?php echo e($distribucion->id); ?>"  >
                <center style="margin-bottom: 25px;"><label >Descripción</label></center>
                <select class="form-control desc2" name="distribucion[descripcion_dis][]" style="width:100%" id="desc">
                  <option value="<?php echo e($distribucion->descripcion); ?>"><?php echo e($distribucion->descripcion); ?></option>
                  <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
                  <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center style="margin-bottom: 25px;"><label >Tipo</label></center>
                <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                  <option value="<?php echo e($distribucion->tipo); ?>"><?php echo e($distribucion->tipo); ?></option>
                  <option value="Aérea">Tipo Aérea</option>
                  <option value="Subterránea">Tipo subterránea</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center><label >Nivel de tensión  </label></center>
                <select class="form-control tipo2" name="distribucion[nivel_tension_dis][]" style="width:100%" id="tension">
                  <option value="<?php echo e($distribucion->nivel_tension); ?>"><?php echo e($distribucion->nivel_tension); ?></option>

                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center><label >Longitud de red (km)</label></center>
                <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="<?php echo e($distribucion->cantidad); ?>" name="distribucion[cantidad_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center><label >Apoyos o estructuras</label></center>
                <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" value="<?php echo e($distribucion->apoyos); ?>" name="distribucion[apoyos_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center><label >Cajas de inspección</label></center>
                <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" value="<?php echo e($distribucion->cajas); ?>" name="distribucion[cajas_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center style="margin-bottom: 25px;"><label >Notas</label></center>
                <input type="text" class="form-control" placeholder= "Notas" value="<?php echo e($distribucion->notas); ?>" name="distribucion[notas_dis][]">
              </div>
            </div>
            <div class="box-footer">
              <a href="<?php echo e(url('deletedistri')); ?>/<?php echo e($distribucion->id); ?>" onClick="alert(<?php echo e($distribucion->id); ?>);"><i class="glyphicon glyphicon-minus-sign"></i></a>

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