<style media="screen">
  #password, #rol_id{
    width: 90%;
  }
</style>
<?php $__env->startSection('contenido'); ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
    <li><a href="<?php echo e(url('usuarios')); ?>">Usuarios</a></li>
    <li class="active">Crear Usuario</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Crear Usuario</h3>
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
        <?php echo Form::open(['url' => 'usuarios']); ?>

        <?php echo e(csrf_field()); ?>

        <div class="box-body col-md-6">
          <br>


          <div class="form-group">
            <?php echo Form::label('cedula', 'Cédula'); ?>

            <?php echo Form::number('cedula', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('nombres', 'Nombres'); ?>

            <?php echo Form::text('nombres', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('apellidos', 'Apellidos'); ?>

            <?php echo Form::text('apellidos', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>
        </div>
        <div class="box-body col-md-6">
          <br>
          <div class="form-group">
            <?php echo Form::label('email', 'Email'); ?>

            <?php echo Form::text('email', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('password', 'Contraseña'); ?>

            <?php echo Form::password('password', null, ['class' => 'form-control' , 'required' => 'required']); ?>

            <span id="show-pass" class="glyphicon glyphicon-eye-open"></span>

          </div>
          <br>
          <div class="form-group">
            <?php echo Form::label('rol_id', 'Rol'); ?>

            <?php echo Form::select('rol_id',$roles,['class' => 'form-control','required' => 'required']); ?>

          </div>
        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
        </div>
      <?php echo Form::close(); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

  <script type="text/javascript">
  $(document).ready(function () {
     $('#show-pass').click(function () {
      if ($('#password').attr('type') === 'text') {
       $('#password').attr('type', 'password');
      } else {
       $('#password').attr('type', 'text');
      }
     });
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>