<?php $__env->startSection('contenido'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
  <li class="active">Usuarios</li>
</ol>
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
        <div class="row">
          <div class="col-md-12 well">
            <div class="box-body">
              <a href="<?php echo e(url('usuarios/create')); ?>" class="btn btn-primary" data-toggle="modal" ><i class="fa fa-user-plus"></i> Crear Usuario</a>
              <br>
              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Cédula</th>
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
                    <td>
                      <a href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="<?php echo e(url('deleteusuarios')); ?>/<?php echo e($usuario->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                    </td>


                    </tr>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
    $(function () {
      $('table').dataTable( {
        "language":{
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
          "scrollX": true

  } );
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>