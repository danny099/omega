<?php $__env->startSection('contenido'); ?>

<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3> </center>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="<?php echo e(url('administrativa')); ?>">
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
          <div class="col-md-1">
            <a class="btn btn-warning" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
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
  </form>
</div>
</div>


<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
  </div>
  <form role="form" action="<?php echo e(url('administrativa')); ?> ">
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
          <center><label >Unidad</label></center>
          <center><h5>Km.</h5></center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad">
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
          <center><label >Unidad</label></center>
          <center><h5>Und.</h5></center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_dis">
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
          <center><label >Unidad</label></center>
          <center><h5>Und</h5></center>
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
      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;"  >Agregar</button>
      </div>
    </form>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>