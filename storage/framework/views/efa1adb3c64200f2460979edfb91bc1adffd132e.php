<?php $__env->startSection('contenido'); ?>

      <div class="container">
        <?php if(Session::has('message')): ?>
          <div id="alert">
            <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
            <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-<?php echo e(Session::get('class')); ?>">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo e(Session::get('message')); ?>

            </div>
          </div>
        <?php endif; ?>
        <div class="col-md-12 well">
          <div class="box-body">

            <a href="<?php echo e(url('usuarios/create')); ?>" class="btn btn-primary" data-toggle="modal" ><i class="fa fa-user-plus"></i> Crear Usuario</a>
            <br>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
              </thead>

                <tbody>
                  <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($usuario->cedula); ?></td>
                  <td><?php echo e($usuario->nombres); ?></td>
                  <td><?php echo e($usuario->apellidos); ?></td>
                  <td><?php echo e($usuario->email); ?></td>
                  <td><?php echo e($usuario->roles->rol); ?></td>
                  <td><a href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>"><i class="glyphicon glyphicon-pencil"></i></a></td>
                  <td><a href="<?php echo e(url('deleteusuarios')); ?>/<?php echo e($usuario->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a></td>

                </tr>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

              <tfoot>

              </tfoot>
            </table>
          </div>
        </div>
        </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>