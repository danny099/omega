<style media="screen">

  textarea{
    width:100%;
    resize: none;
  }
</style>
<script type="text/javascript">

function mascara(o,f){
  v_obj=o;
  v_fun=f;
  setTimeout("execmascara()",1);
}
function execmascara(){
  v_obj.value=v_fun(v_obj.value);
}
function cpf(v){
  v=v.replace(/([^0-9\.]+)/g,'');
  v=v.replace(/^[\.]/,'');
  v=v.replace(/[\.][\.]/g,'');
  v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2');
  v=v.replace(/\.(\d{1,2})\./g,'.$1');
  v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');
  v = v.split('').reverse().join('').replace(/^[\,]/,'');
  return v;
}
function calcular(){
  var varMonto;
  var varIva;
  var varSubTotal;

  varMonto = document.getElementById("fin").value;
  varMonto = varMonto.replace(/[\,]/g,'');

  varIva = parseFloat(varMonto) /1.19;
  document.getElementById("ini").value = addCommas(Math.round(varIva)) ;

  varSubTotal = parseFloat(varMonto) - parseFloat(varIva);
  document.getElementById("iva").value = addCommas(Math.round(varSubTotal)) ;

}

function addCommas(nStr){
  nStr += '';
  x = nStr.split(',');
  x1 = x[0];
  x2 = x.length > 1 ? ',' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}

</script>
<?php $__env->startSection('contenido'); ?>

  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
    <li><a href="<?php echo e(url('administrativas')); ?>">Administrativa</a></li>
    <li class="active">Crear Proyecto</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Datos del proyecto</h3> </center>
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
  <form role="form" name="form1" action="<?php echo e(url('administrativas')); ?>" method="post" >
    <?php echo e(csrf_field()); ?>

    <div class="box-body">
        <div class="col-md-4">
          <div class="form-group">
            <label>Código del proyecto:</label>
            <input id="codigo" type="text" class="form-control" placeholder="Ingrese código"  name="codigo" required pattern="[A-Z]{3}[-]{1}[0-9]{4}[-]{1}[0-9]{3}">
          </div>
          <div class="form-group">
            <label>Nombre del proyecto</label>
            <input type="text" class="form-control" value="<?php echo e($cotizaciones->nombre); ?> "placeholder="Ingrese nombre" name="nombre" required="Ingrese nombre del proyecto">
          </div>
          <div class="form-group">
            <label>Fecha del contrato:</label>
            <input type="date" class="form-control pull-right" name="fecha" id="datepicker" required="Ingrese una fecha">
          </div>
          <?php if(empty($cotizaciones->juridica->id )): ?>
            <div class="form-group">
              <label>Tipo de régimen</label>
              <select class="form-control" name="tipo_regimen" id="cliente" required="">
                <option value="1">Persona natural</option>
                <option value="2">Persona jurídica</option>
              </select>
            </div>
            <div class="form-group" style="width: 100%" id="natural">
              <label >Persona natural</label>
              <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
                <option value="<?php echo e($cotizaciones->cliente->id); ?>"><?php echo e($cotizaciones->cliente->nombre); ?></option>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group" style="Display:none" style="width: 100%" id="juridica">
              <label >Persona juridica</label>
              <select class="form-control" name="juridica_id" style="width: 100%" id="juri">
                <option value="">Seleccione...</option>
                <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          <?php endif; ?>
          <?php if(empty($cotizaciones->cliente->id )): ?>
            <div class="form-group">
              <label>Tipo de régimen</label>
              <select class="form-control" name="tipo_regimen" id="cliente" required="">
                <option value="2">Persona jurídica</option>
                <option value="1">Persona natural</option>
              </select>
            </div>
            <div class="form-group" style="Display:none" style="width: 100%" id="natural">
              <label >Persona natural</label>
              <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
                <option value="">Seleccione...</option>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group"  style="width: 100%" id="juridica">
              <label >Persona juridica</label>
              <select class="form-control" name="juridica_id" style="width: 100%" id="juri">

                <option value="<?php echo e($cotizaciones->juridica->id); ?>"><?php echo e($cotizaciones->juridica->razon_social); ?></option>
                <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label >Departamento</label>
            <select class="form-control" name="departamento" id="departamento" required="">
              <option value="<?php echo e($cotizaciones->departamento->id); ?>"><?php echo e($cotizaciones->departamento->nombre); ?></option>
              <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($departamento->id); ?>"><?php echo e($departamento->nombre); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
            <select class="form-control" name="municipio" id="municipio" required="">
              <option value="<?php echo e($municipio->id); ?>"><?php echo e($municipio->nombre); ?></option>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label >Tipo de zona</label>
            <select class="form-control" name="zona">
              <option value="Urbana">Urbana</option>
              <option value="Rural">Rural</option>
              <option value="Urbana/Rural">Urbana/Rural</option>
            </select>
          </div>
          <div class ="form-group">
            <label >Valor contrato final</label>
            <input type="text" min="0" value="<?php echo e(number_format($cotizaciones->total,0)); ?>" class="form-control" id="fin" autocomplete="off" placeholder= "Valor final" name="contrato_final"  onkeyup="calcular(); mascara(this,cpf)"  onkeyup="mascara(this,cpf)"  onpaste="return false" required="ingrese así sea un cero" >

          </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
              <label >Valor IVA</label>
              <input type="text" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor IVA" name="iva" value="<?php echo e(number_format($cotizaciones->iva,0)); ?>"  >

            </div>
            <div class="form-group">
              <label >Valor antes de IVA</label>

              <input type="text" min="0" id="ini" value="<?php echo e(number_format($cotizaciones->subtotal,0)); ?>" class="form-control"  readonly="readonly" placeholder= "Valor antes IVA" name="contrato_inicial" >

            </div>

            <div class="form-group">
              <label >Plan de pago</label>
              <select name="formas_pago" style="width:100%" required>
                <option value="<?php echo e($cotizaciones->formas_pago,0); ?>"><?php echo e($cotizaciones->formas_pago,0); ?></option>
                <option value="Anticipo 100%">Anticipo 100%</option>
                <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
                <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
                <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
                <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
              </select>
            </div>
        </div>
        <hr>
        </div>


  <div class="box box-primary">
    <div class="box-body">
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de distribución en MT</h3> </center>
      </div>
      <?php if(count($mts) == 0): ?>
        <input type="hidden"  name="distribucion" value="distribucion"  >
      <?php else: ?>
      <?php $__currentLoopData = $mts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-12">
        <div class="col-md-4">
          <div class="form-group">
            <input type="hidden" name="distribucion[id_dis][]" value="<?php echo e($mt->id); ?>">

            <center><label >Descripción</label></center>
            <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en MT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="distribucion[tipo_dis][]" >
              <option value="<?php echo e($mt->tipo); ?>"><?php echo e($mt->tipo); ?></option>
              <option value="Aérea">Tipo Aérea</option>
              <option value="Subterránea">Tipo subterránea</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Unidad</label></center>
            <center>
              <input type="text" class="form-control" value="<?php echo e($mt->unidad); ?>" value="mts."  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center">
            </center>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="<?php echo e($mt->cantidad); ?>" name="distribucion[cantidad_dis][]">

          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <center> <h3>Alcance: proceso de transformación</h3> </center>

      <?php if(count($transformaciones) == 0): ?>
        <input type="hidden"  name="transformacion" value="transformacion"  >
      <?php else: ?>
      <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-12">
        <div class="col-md-4">
          <div class="form-group">
            <input type="hidden" name="transformacion[id][]" value="<?php echo e($transfor->id); ?>">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="transformacion[tipo][]">
              <option value="<?php echo e($transfor->tipo); ?>"><?php echo e($transfor->tipo); ?></option>
              <option value="Tipo poste">Tipo poste</option>
              <option value="Tipo interior">Tipo interior</option>
              <option value="Tipo exterior">Tipo exterior</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Capacidad</label></center>
            <input type="text" class="form-control capacidad" placeholder="Capacidad"   value="<?php echo e($transfor->capacidad); ?>" name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label>Unidad</label></center>
            <center>
              <input style="text-align:center;" type="text" value="<?php echo e($transfor->unidad); ?>" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]">
            </center>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" value="<?php echo e($transfor->cantidad); ?>"  name="transformacion[cantidad][]">

          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de distribución en BT</h3> </center>
      </div>
      <?php if(count($bts) == 0): ?>
        <input type="hidden"  name="distribucion" value="distribucion"  >
      <?php else: ?>
      <?php $__currentLoopData = $bts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-12">
        <div class="col-md-4">
          <div class="form-group">
            <input type="hidden" name="distribucion[id_dis][]" value="<?php echo e($bt->id); ?>">

            <center><label >Descripción</label></center>
            <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en BT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="distribucion[tipo_dis][]" >
              <option value="<?php echo e($bt->tipo); ?>"><?php echo e($bt->tipo); ?></option>
              <option value="Aérea">Tipo Aérea</option>
              <option value="Subterránea">Tipo subterránea</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Unidad</label></center>
            <center>
              <input type="text" class="form-control" value="<?php echo e($bt->unidad); ?>" value="mts."  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center">
            </center>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="<?php echo e($bt->cantidad); ?>" name="distribucion[cantidad_dis][]">

          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>
      <?php if(count($pu_finales) == 0): ?>
        <input type="hidden"  name="pu_final" value="pu_final"  >
      <?php else: ?>
      <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-12">
      <div class="col-md-4">
        <div class="form-group">
          <input type="hidden" name="pu_final[id_pu][]" value="<?php echo e($pu->id); ?>">
          <center><label >Descripción</label></center>
          <select class="form-control"name="pu_final[descripcion_pu][]" id="instalacion">
            <option value="<?php echo e($pu->descripcion); ?>"><?php echo e($pu->descripcion); ?></option>
            <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
            <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
            <option value="Inspección RETIE proceso uso industrial">Inspección RETIE proceso uso industrial</option>

          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="pu_final[tipo_pu][]" id="tipo3">
            <option value="<?php echo e($pu->tipo); ?>"><?php echo e($pu->tipo); ?></option>

          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Unidad</label></center>
          <center>
            <input style="text-align:center;" type="text" value="<?php echo e($pu->unidad); ?>" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]">
          </center>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control cantidad3" value="<?php echo e($pu->cantidad); ?>" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">

        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
      <div class="col-md-12">
        <center> <h3>Observaciones de estado administrativo del proyecto</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" required=""></textarea>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" data-target="" data-toggle="  " class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
    </div>
  </div>
  </form>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


<script type="text/javascript">
$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

  if (instalacion == 'Inspección RETIE proceso uso final residencial') {
    $(this).parent().parent().parent().find("#tipo3").html('');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Casa">Casa</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Apartamentos">Apartamentos</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Zona común">Zona común</option>');

  }
    else if (instalacion == 'Inspección RETIE proceso uso final comercial') {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Local comercial">Local comercial</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }
    else {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }

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

$(document).ready(function($){
  $('#codigo').inputmask('CPS-9999-999');
});

</script>
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>