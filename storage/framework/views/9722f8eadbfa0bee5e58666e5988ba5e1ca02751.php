<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar factura</h3> </center>
  </div>
  <div class="box-body">
    <div class="col-md-12 well">
        <table id="example" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Numero factura</th>
              <th>Fecha de la factura</th>
              <th>Valor antes de iva</th>
              <th>Iva</th>
              <th>Valor con iva</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($factura->num_factura); ?></td>
              <td><?php echo e($factura->fecha_factura); ?></td>
              <td><?php echo e(number_format($factura->valor_factura,0)); ?></td>
              <td><?php echo e(number_format($factura->iva,0)); ?></td>
              <td><?php echo e(number_format($factura->valor_total,0)); ?></td>
              <td>
                <a href="" data-toggle="modal" data-target="#myModal20-<?php echo e($key); ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="<?php echo e(url('deletefactura')); ?>/<?php echo e($factura->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                <!-- inicio modal 1 -->

                <div class="modal fade" id="myModal20-<?php echo e($key); ?>" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        <?php echo $__env->make('facturas.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->
              </td>
            </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
