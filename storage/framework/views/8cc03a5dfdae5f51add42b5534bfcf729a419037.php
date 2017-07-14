<?php $__env->startSection('contenido'); ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('index')); ?>">Inicio</a></li>
    <li><a href="<?php echo e(url('clientes')); ?>">Cliente</a></li>
    <li class="active">Editar persona juridcia</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Editar persona juridica</h3>
      </div>
      <?php if(Session::has('message')): ?>
        <div id="alert">
          <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
          <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-<?php echo e(Session::get('class')); ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(Session::get('message')); ?>

          </div>
        </div>
      <?php endif; ?>
      <!-- /.box-header -->
      <!-- form start -->
        <?php echo Form::model($juridica, ['method' => 'PATCH', 'action' => ['JuridicaController@update',$juridica->id]]); ?>

        <?php echo e(csrf_field()); ?>

        <div class="box-body col-md-6">
          <br>

          <div class="form-group">
            <?php echo Form::label('razon_social', 'Razón social'); ?>

            <?php echo Form::text('razon_social', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('nit', 'Nit'); ?>

            <?php echo Form::text('nit', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('nombre_representante', 'Nombre representante'); ?>

            <?php echo Form::text('nombre_representante', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('cedula', 'Cédula'); ?>

            <?php echo Form::text('cedula', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <label >Departamento</label>
            <select class="form-control" required="" name="departamento_id" id="departamento">
              <option value="<?php echo e($juridica->departamento->id); ?>"><?php echo e($juridica->departamento->nombre); ?></option>
              <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($departamento->id); ?>"><?php echo e($departamento->nombre); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
            <select class="form-control" required="" name="municipio" id="municipio">
              <option value="<?php echo e($municipio->id); ?>"><?php echo e($municipio->nombre); ?></option>
              <option value=""></option>
            </select>
          </div>


        </div>
        <div class="box-body col-md-6">
          <br>


            <div class="form-group">
              <?php echo Form::label('direccion', 'Dirección'); ?>

              <?php echo Form::text('direccion', null, ['class' => 'form-control' ]); ?>

            </div>

            <div class="form-group">
              <?php echo Form::label('telefono', 'Teléfono'); ?>

              <?php echo Form::text('telefono', null, ['class' => 'form-control' ]); ?>

            </div>

            <div class="form-group">
              <?php echo Form::label('email', 'Email'); ?>

              <?php echo Form::email('email', null, ['class' => 'form-control' ]); ?>

            </div>

        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>
      <?php echo Form::close(); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <script type="text/javascript">
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

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>