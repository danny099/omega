
<div class="container">
  <div class="">
    <div class="">
      <h3 >Crear persona natural</h3>
    </div>
      <!-- /.box-header -->
      <!-- form start -->
        <?php echo Form::open(['url' => 'clientes']); ?>

        <?php echo e(csrf_field()); ?>

        <div class="box-body col-md-6">

          <div class="form-group">
            <?php echo Form::label('nombre', 'Nombre'); ?>

            <?php echo Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('nit', 'Nit'); ?>

            <?php echo Form::text('nit', null, ['class' => 'form-control' ]); ?>

          </div>

          <div class="form-group">
            <?php echo Form::label('cedula', 'Cédula'); ?>

            <?php echo Form::text('cedula', null, ['class' => 'form-control']); ?>

          </div>

          <div class="form-group">
            <label >Departamento</label>
              <select class="form-control" name="departamento" style="width: 100%" id="departamento" required="">
                <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($departamento->id); ?>"><?php echo e($departamento->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
              <select class="form-control" name="municipio" style="width: 100%" id="municipio" required="">
                <option value=""></option>
              </select>
          </div>

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
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
            <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left" style="background-color: #33579A; border-color:#33579A;">Cancelar</button>
          </div>

        </div>
        <!-- /.box-body -->
        <br>
      </div>

      <?php echo Form::close(); ?>

    </div>
  </div>

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
