<?php $__env->startSection('scripts'); ?>
<script>
  $(function () {
    $('table.display').dataTable( {
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
  $(document).ready(function(){
  $(document).on('change','#departamento',function(){

  var dep_id = $(this).val();
  var div = $(this).parents();
  var op=" ";
  $.ajax({
  type:'get',
  url:'<?php echo e(url('selectmuni')); ?>',
  data:{'id':dep_id},
  success:function(data){
  console.log(data);
  op+='<option value="0" selected disabled>Seleccione</option>';

  for (var i = 0; i < data.length; i++) {
  op+='<option value="' +data[i].id+ '">' +data[i].nombre+ '</option>'
  }

  div.find('#municipio').html(" ");
  div.find('#municipio').append(op);

  },
  error:function(){

  }
  });
  });
  });

</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
  <li class="active">Clientes</li>
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
    <div class="col-md-12 well">
      <div class="box-body">
        <a href="#modal" class="btn btn-primary" data-toggle="modal" style="background-color: #33579A; border-color:#33579A;"><i class="fa fa-user-plus"></i> Crear Cliente</a>
        <br>
        <br>
        <div class="box box-primary">
          <div class="box-header with-border">
            <center> <h3 >Personas naturales</h3> </center>
          </div>
          <table id="example1" class="table table-bordered table-striped display">
            <thead>
              <tr>
                <th>Nit</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Télefono</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($cliente->nit); ?></td>
                <td><?php echo e($cliente->cedula); ?></td>
                <td><?php echo e($cliente->nombre); ?></td>
                <td><?php echo e($cliente->telefono); ?></td>
                <td><?php echo e($cliente->direccion); ?></td>
                <td><?php echo e($cliente->email); ?></td>
                <td>
                  <a href="<?php echo e(route('clientes.edit', $cliente->id)); ?>"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="<?php echo e(url('deleteclientes')); ?>/<?php echo e($cliente->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <center> <h3 >Personas jurídicas</h3> </center>
          </div>
          <table id="example2" class="table table-bordered table-striped display">
            <thead>
              <tr>
                <th>Razón social</th>
                <th>Nit</th>
                <th>Nombre representante</th>
                <th>Cédula</th>
                <th>Dirección</th>
                <th>Télefono</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($juridica->razon_social); ?></td>
                <td><?php echo e($juridica->nit); ?></td>
                <td><?php echo e($juridica->nombre_representante); ?></td>
                <td><?php echo e($juridica->cedula); ?></td>
                <td><?php echo e($juridica->direccion); ?></td>
                <td><?php echo e($juridica->telefono); ?></td>
                <td><?php echo e($juridica->email); ?></td>
                <td>
                  <a href="<?php echo e(route('juridica.edit', $juridica->id)); ?>"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="<?php echo e(url('deletejuridica')); ?>/<?php echo e($juridica->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
        <!-- modal 1 -->
        <div class="modal fade" id="modal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Clientes</h4>
              </div>
              <div class="modal-body">
                <center><h4> ¿Desea crear un cliente? </h4></center>
                <br>
                <center>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2" name="button" style="background-color: #33579A; border-color:#33579A;">Persona natural</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3" name="button" style="background-color: #33579A; border-color:#33579A;">Persona jurídica</button>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
          <!-- fin modal -->
          <!-- modal 2 -->
        <div class="modal fade" id="modal2"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              <?php echo $__env->make('clientes.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
        <!-- fin modal2 -->
        <!-- modal 3 -->
        <div class="modal fade" id="modal3"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <?php echo $__env->make('juridica.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
      <!-- fin modal3 -->
      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>