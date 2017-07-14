<?php $__env->startSection('contenido'); ?>

      <div class="container">
        <div class="col-md-12 well">
          <a class="btn btn-primary" data-toggle="modal" href="<?php echo e(url('administrativas/create')); ?>"><i class="fa fa-user-plus"></i> Crear Contrato</a>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Codigo del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Fecha del contrato</th>
                <th>Cliente</th>
                <th>Valor final del contrato</th>
              </tr>
              </thead>

                <tbody>
                  <?php $__currentLoopData = $administrativas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $administrativa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($administrativa->codigo_proyecto); ?></td>
                  <td><?php echo e($administrativa->nombre_proyecto); ?>

                  </td>
                  <td><?php echo e($administrativa->fecha_contrato); ?></td>
                  <td> <?php echo e($administrativa->cliente->nombre); ?></td>
                  <td><?php echo e($administrativa->valor_contrato_final); ?></td>
                </tr>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

              <tfoot>
              <tr>
                <th>Codigo del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Fecha del contrato</th>
                <th>Cliente</th>
                <th>Valor final del contrato</th>
              </tr>
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