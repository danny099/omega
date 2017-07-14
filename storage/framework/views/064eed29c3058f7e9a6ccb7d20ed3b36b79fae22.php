<?php $__env->startSection('contenido'); ?>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
      <li class="active">Auditoría</li>
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
        <div class="row" >
          <div class="col-md-12 well">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Modulo</th>
                    <th>Registro</th>
                    <th>Antiguo registro</th>
                    <th>Nuevo registro</th>
                    <th>Fecha y hora</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $auditorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auditoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($auditoria->user_id); ?></td>
                    <?php if( $auditoria->event == 'created'): ?>
                      <td> Creo </td>
                    <?php elseif($auditoria->event == 'updated'): ?>
                      <td> Actualizo </td>
                    <?php else: ?>
                      <td>Elimino </td>
                    <?php endif; ?>

                    <?php
                    $modulo = str_replace('App\\','',$auditoria->auditable_type);
                     ?>
                    <td><?php echo $modulo ?></td>

                    <td class="td"><?php echo e($auditoria->auditable_id); ?></td>

                    <?php
                    $modulo = str_replace('"','',$auditoria->old_values);
                    $modulo2 = str_replace('{','',$modulo);
                    $modulo3 = str_replace('}','',$modulo2);
                    $modulo4 = str_replace(',','<br>',$modulo3);
                    $modulo5 = str_replace(':',': ',$modulo4);

                     ?>
                    <td><?php echo $modulo5 ?></td>

                    <?php
                    $modulo = str_replace('"','',$auditoria->new_values);
                    $modulo2 = str_replace('{','',$modulo);
                    $modulo3 = str_replace('}','',$modulo2);
                    $modulo4 = str_replace(',','<br>',$modulo3);
                    $modulo5 = str_replace(':',': ',$modulo4);

                     ?>
                    <td><?php echo $modulo5 ?></td>
                    <td><?php echo e(date_format(new DateTime($auditoria->created_at ),'d-m-y H:i:s')); ?></td>
                  </tr>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
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

    $(document).ready(function($){
      var prueba= $('.prueba').val();
      var obj = JSON.parse(prueba);

      $('.td').after(obj[0])

    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>