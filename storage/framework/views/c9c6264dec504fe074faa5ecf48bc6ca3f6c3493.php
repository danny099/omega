
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Alcance: proceso de transformación</h3> </center>
    </div>
    <div class="box-body">

      <form class="form1" action="<?php echo e(url('editart')); ?>" method="post">
      <?php echo e(csrf_field()); ?>


      <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input type="hidden" name="transformacion[id][]" value="<?php echo e($transfor->id); ?>">
      <div class="row quitar50" id="quitar50">
        <center> <h3>Alcance: proceso de transformación</h3> </center>

      <div class="col-md-12">
        <div class="col-md-3">
          <input type="hidden"  name="transformacion[id][]" value="<?php echo e($transfor->id); ?>"  >
          <div class="form-group">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control tipo" name="transformacion[tipo][]" style="width:100%">
              <option value="<?php echo e($transfor->tipo); ?>"><?php echo e($transfor->tipo); ?></option>
              <option value="Tipo poste">Tipo poste</option>
              <option value="Tipo interior">Tipo interior</option>
              <option value="Tipo pedestal/jardin">Tipo pedestal/jardin</option>
              <option value="Tipo patio">Tipo Patio</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Nivel de tensión (KV)</label></center>
            <select class="form-control" name="transformacion[nivel_tension][]" style="width:100%">
              <option value="<?php echo e($transfor->nivel_tension); ?>"><?php echo e($transfor->nivel_tension); ?></option>
              <option value="13,2">13,2</option>
              <option value="13,4">13,4</option>
              <option value="13,8">13,8</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Capacidad (KVA)</label></center>
              <input type="text" class="form-control capacidad" placeholder="Capacidad"   value="<?php echo e($transfor->capacidad); ?>" name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" value="<?php echo e($transfor->cantidad); ?>"  name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Refrigeración </label></center>
            <select class="form-control" name="transformacion[tipo_refrigeracion][]" style="width:100%">
              <option value="<?php echo e($transfor->tipo_refrigeracion); ?>"><?php echo e($transfor->tipo_refrigeracion); ?></option>
              <option value="Seco">Seco</option>
              <option value="Aceite">Aceite</option>
            </select>
          </div>
        </div>
        <div class="box-footer">
          <a href="<?php echo e(url('deletetransfor')); ?>/<?php echo e($transfor->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>

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
