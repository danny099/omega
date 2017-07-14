<?php $__env->startSection('contenido'); ?>

  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
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
        <?php echo Form::open(['url' => 'clientes']); ?>

        <?php echo e(csrf_field()); ?>

        <div class="box-body col-md-6">
          <br>


          <div class="form-group">
            <?php echo Form::label('nit', 'Nit'); ?>

            <?php echo Form::number('nit', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('cedula', 'Cedula'); ?>

            <?php echo Form::text('cedula', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('nombre', 'Nombre'); ?>

            <?php echo Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('contacto', 'Contacto'); ?>

            <?php echo Form::text('contacto', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>


        </div>
        <div class="box-body col-md-6">
          <br>

          <div class="form-group">
            <?php echo Form::label('telefono', 'Telefono'); ?>

            <?php echo Form::number('telefono', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('direccion', 'Direccion'); ?>

            <?php echo Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('email', 'Email'); ?>

            <?php echo Form::email('email', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>


        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </div>
      <?php echo Form::close(); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>