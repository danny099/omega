<script type="text/javascript">
  function mascara(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("execmascara()",1);
  }
  function execmascara(){
    v_obj.value=v_fun(v_obj.value);
  }
  function cpf(v){
    v=v.replace(/([^0-9\.]+)/g,'');
    v=v.replace(/^[\.]/,'');
    v=v.replace(/[\.][\.]/g,'');
    v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2');
    v=v.replace(/\.(\d{1,2})\./g,'.$1');
    v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');
    v = v.split('').reverse().join('').replace(/^[\,]/,'');
    return v;
  }
  </script>
<?php $__env->startSection('contenido'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
  <li class="active">Crear adicionales</li>
</ol>
<?php if(Session::has('message')): ?>
<div id="alert">
  <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
  <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-<?php echo e(Session::get('class')); ?>">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo e(Session::get('message')); ?>

  </div>
</div>
<?php endif; ?>
  <form class="" action="<?php echo e(url('adicionales')); ?>" method="post" autocomplete="off">
    <?php echo e(csrf_field()); ?>

    <div class="box box-primary">
      <div class="col-md-12">
        <center> <h3>Valor adicional</h3> </center>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select" required="">
                  <option value="">Seleccione...</option>
                  <?php $__currentLoopData = $codigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($codigo->id); ?>"><?php echo e($codigo->codigo_proyecto); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <center><label >Valor adicional</label></center>
                <input type="text" class="form-control" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="adicional[valor][]" required="">
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <center><label >Detalle</label></center>
                <input type="text" class="form-control" placeholder= "Detalle" name="adicional[detalle][]"required="">
              </div>
            </div>

            <div class="col-md-1" id="tblprod5" >
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" id="btnadd5" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">
          Guardar
        </button>
      </div>
    </div>
  </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>