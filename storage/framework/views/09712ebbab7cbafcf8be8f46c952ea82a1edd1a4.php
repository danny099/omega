<?php $__env->startSection('contenido'); ?>

      <div class="container">
        <div class="col-md-12 well">
          <a class="btn btn-primary" href="<?php echo e(url('administrativas/create')); ?>"><i class="fa fa-user-plus"></i> Crear Contrato</a>
          <div class="box-body">
            <?php if(Session::has('message')): ?>
              <div id="alert">
                <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
                <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-<?php echo e(Session::get('class')); ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo e(Session::get('message')); ?>

                </div>
              </div>
            <?php endif; ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Codigo del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Fecha del contrato</th>
                <th>Cliente</th>
                <th>Valor final del contrato</th>
                <th>Acciones</th>
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
                  <td>
                      <a href="<?php echo e(route('administrativas.edit', $administrativa->id)); ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="#createModal" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="<?php echo e(url('deleteadminstrativa')); ?>/<?php echo e($administrativa->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                  </td>
                  <td></td>
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

        <div class="example-modal">
          <div class="modal fade bs-example-modal-lg" aria-labelledby="myLargeModalLabel" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <center> <h3 class="box-title">Datos del proyecto</h3> </center>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo e(url('administrativas')); ?>" method="post">
                      <?php echo e(csrf_field()); ?>

                      <div class="box-body">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label >Codigo del proyecto:</label>
                            <input type="text" class="form-control" placeholder="Ingrese codigo" name="codigo">
                          </div>
                          <div class="form-group">
                            <label >nombre del proyecto</label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre">
                          </div>
                          <div class="form-group">
                            <label >Fecha del contrato:</label>
                            <input type="date" class="form-control" name="fecha">
                          </div>
                          <div class="form-group">
                            <label >Cliente</label>
                            <select class="form-control" name="cliente_id">
                              <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>

                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label >Propietario</label>
                            <input type="text" class="form-control" placeholder="Ingresa propietario" name="propietario">
                          </div>

                          <div class="form-group">
                            <label >Departamento</label>
                            <select class="form-control" name="departamento">

                            </select>
                          </div>
                          <div class="form-group">
                            <label >Ciudad</label>
                            <select class="form-control" name="municipio">

                            </select>
                          </div>
                          <div class="form-group">
                            <label >Tipo de zona</label>
                            <select class="form-control" name="zona">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">

                          <div class="form-group">
                            <label >Valor contrato inicial</label>
                            <input type="number" class="form-control" placeholder= "Ingrese valor" name="contrato_inicial">
                          </div>
                          <label >Otro si</label>
                          <div class="form-group ">
                            <div class="col-md-11">
                              <input type="number" class="form-control" placeholder= "Ingrese valor" name="otrosi">
                            </div>

                            <div class="form-group">
                              <br>
                              <br>
                              <label >Valor contrato final</label>
                              <input type="number" class="form-control" placeholder= "Ingrese valor" name="contrato_final">
                            </div>
                            <div class="form-group">
                              <label >Plan de pago</label>
                              <input type="number" class="form-control" placeholder= "Ingrese valor" name="plan_pago">
                            </div>
                          </div>
                        </div>
                        <hr>

                  </div>
                  </div>


                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
                    </div>

                      <div class="box-body">
                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Descripcion</label></center>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="descripcion">

                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Tipo</label></center>
                            <select class="form-control" name="tipo">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Capacidad</label></center>
                            <select class="form-control" name="capacidad">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label>Unidad</label></center>
                            <center>
                              <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_transformacion">
                            </center>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label >Cantidad</label></center>
                            <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad">
                          </div>
                        </div>



                        <div class="col-md-12">
                          <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Descripcion</label></center>
                          </div>
                          <div class="form-group">
                            <select class="form-control" name="descripcion_dis">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Tipo</label></center>
                            <select class="form-control" name="tipo_dis">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Capacidad</label></center>
                            <select class="form-control" name="capacidad_dis">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label >Unidad</label></center>
                            <center>
                              <input type="text" class="form-control" value="Km"  readonly=”readonly” name="unidad_distribucion">
                            </center>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label >Cantidad</label></center>
                            <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_dis">
                          </div>
                        </div>



                        <div class="col-md-12">
                          <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Descripcion</label></center>
                          </div>
                          <div class="form-group">
                            <select class="form-control"name="descripcion_pu">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Tipo</label></center>
                            <select class="form-control" name="tipo_pu">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <center><label >Capacidad</label></center>
                            <select class="form-control" name="capacidad_pu">

                            </select>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label >Unidad</label></center>
                            <center>
                              <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_pu_final">
                            </center>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <center><label >Cantidad</label></center>
                            <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_pu">
                          </div>
                        </div>

                        <div class="col-md-1">
                          <div class="form-group">
                            <br>
                            <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <center> <h4 class="box-title">Resumen de estado administrativo del proyecto</h4> </center>
                        </div>

                        <div class="col-md-12">
                          <textarea name="name" rows="4" cols="250" name="resumen"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
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