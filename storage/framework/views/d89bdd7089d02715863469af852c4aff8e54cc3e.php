<?php $__env->startSection('contenido'); ?>

<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3> </center>
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
  <?php echo Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]); ?>

  <?php echo e(csrf_field()); ?>


    <div class="box-body">
      <div class="col-md-4">
        <div class="form-group">
          <?php echo Form::label('codigo', 'Codigo del proyecto:'); ?>

          <?php echo Form::text('codigo', $administrativas->codigo_proyecto, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
        <div class="form-group">
          <?php echo Form::label('nombre', 'Nombre del proyecto'); ?>

          <?php echo Form::text('nombre', $administrativas->nombre_proyecto, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
        <div class="form-group">
          <?php echo Form::label('fecha', 'Fecha del contrato:'); ?>

          <?php echo Form::date('fecha', $administrativas->fecha_contrato, ['class' => 'form-control' , 'required' => 'required']); ?>

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
          <?php echo Form::label('propietario', 'Propietario:'); ?>

          <?php echo Form::text('propietario', $administrativas->propietario, ['class' => 'form-control' , 'required' => 'required']); ?>

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

          <?php echo Form::label('contrato_inicial', 'Valor contrato inicial:'); ?>

          <?php echo Form::text('contrato_inicial', $administrativas->valor_contrato_inicial, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
        <?php echo Form::label('otrosi', 'Otro si:'); ?>

        <div class="form-group ">
          <div class="col-md-11">
            <?php echo Form::number('otrosi',$administrativas->otrosi->valor, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>
          <div class="col-md-1">
            <a class="btn btn-warning" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
          <div class="form-group">
            <br>
            <br>
            <?php echo Form::label('contrato_final', 'Valor contrato final:'); ?>

            <?php echo Form::number('contrato_final', $administrativas->valor_contrato_final, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label('plan_pago', 'Plan de pagos:'); ?>

            <?php echo Form::number('plan_pago',$administrativas->plan_pago, ['class' => 'form-control' , 'required' => 'required']); ?>

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
          <center><?php echo Form::label('descripcion', 'Descripcion'); ?></center>
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
          <center><label ><?php echo Form::label('cantidad', 'Cantidad'); ?></label></center>
          <?php echo Form::number('cantidad', $administrativas->transformacion->cantidad, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
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
          <center><?php echo Form::label('plan_pago', 'Unidad'); ?></center>
          <center>
            <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_distribucion">

          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><?php echo Form::label('cantidad_dis', 'Cantidad'); ?></center>
          <?php echo Form::text('cantidad_dis', $administrativas->distribucion->cantidad, ['class' => 'form-control' , 'required' => 'required']); ?>

        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
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
          <center><?php echo Form::label('unidad_pu_final', 'Unidad'); ?></center>
          <center>
            <input type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_pu_final">
          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><?php echo Form::label('cantidad_pu', 'Cantidad'); ?></center>
          <?php echo Form::text('cantidad_pu',null, ['class' => 'form-control' , 'required' => 'required']); ?>

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
        <textarea name="name" rows="4" cols="250" name="resumen" value="<?php echo e($administrativas->resumen); ?>"></textarea>
      </div>
    </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;"  >Agregar</button>
      </div>
    <?php echo Form::close(); ?>

  </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>