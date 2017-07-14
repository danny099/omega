<style media="screen">
  .separar{
    height: 80px;
  }
  select{
    font-size: 15px;
  }
  ul{
    margin: 20px;
  }
  textarea{
    width:95%;
    resize: none;
  }

</style>
<link rel="stylesheet" href=" <?php echo e(url('bootstrap/css/jquery.steps.css')); ?>">
<?php $__env->startSection('contenido'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
  <li><a href="<?php echo e(url('cotizaciones')); ?>">Cotización</a></li>
  <li class="active">Editar cotización</li>
</ol>

  <div class="box box-primary" >
    <div class="box-header with-border">
      <center> <h3>Cotización</h3> <h3><?php echo e($cotizaciones->codigo); ?></h3> </center>
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

    <?php echo Form::model($cotizaciones, ['id'=>'form','method' => 'PATCH', 'action' => ['CotizacionController@update',$cotizaciones->id]]); ?>

    <?php echo e(csrf_field()); ?>


    <div class="">


    <h3>Paso 1</h3>
    <section>
    <div class="">
      <center> <h3>Datos</h3> </center>

      <div class="col-md-12">
        <div class="col-md-3">
          <input type="hidden" name="codigo" value="<?php echo e($cotizaciones->codigo); ?>">
          <input type="hidden"  name="id" value="<?php echo e($cotizaciones->id); ?>"  >
          <label>Dirigido a :</label>
          <select name="dirigido" style="width:100%" >
            <option value="<?php echo e($cotizaciones->dirigido); ?>"><?php echo e($cotizaciones->dirigido); ?></option>
            <option value="Señor">Señor</option>
            <option value="Señora">Señora</option>
            <option value="Señores">Señores</option>
            <option value="Ingeniero">Ingeniero</option>
            <option value="Ingeniera">Ingeniera</option>
            <option value="Arquitecto">Arquitecto</option>
            <option value="Arquitecta">Arquitecta</option>
          </select>
        </div>
        <?php if(empty($cotizaciones->juridica->id )): ?>
        <div class="col-md-3">
          <label>Tipo de régimen</label>
          <select class="" name="tipo_regimen" id="cliente" style="width: 100%" required="">
            <option value="1">Persona natural</option>
            <option value="2">Persona jurídica</option>
          </select>
        </div>
        <div class="col-md-3"  id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%;" id="select-natural">
            <option value="<?php echo e($cotizaciones->cliente->id); ?>"><?php echo e($cotizaciones->cliente->nombre); ?></option>
            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3" style="Display:none" id="juridica">
          <label >Persona jurídica </label>
          <select class="form-control" name="juridica_id" style="width: 100%;" >
            <option value="">Seleccione</option>
            <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <?php endif; ?>
        <?php if(empty($cotizaciones->cliente->id )): ?>
        <div class="col-md-3">
          <label>Tipo de régimen</label>
          <select class="" name="tipo_regimen" id="cliente" style="width: 100%" required="">
            <option value="2">Persona jurídica</option>
            <option value="1">Persona natural</option>
          </select>
        </div>
        <div class="col-md-3" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" style="Display:none;width: 100%;" name="cliente_id" id="select-natural">
            <option value="">Seleccione</option>
            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3"  id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" style="width: 100%;" >
            <option value="<?php echo e($cotizaciones->juridica->id); ?>"><?php echo e($cotizaciones->juridica->razon_social); ?></option>
            <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <?php endif; ?>
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Nombre del proyecto:</label>
          <input type="text" class="form-control" value="<?php echo e($cotizaciones->nombre); ?>" name="nombre" required="Ingrese nombre del proyecto">
        </div>
        <div class="col-md-3">
          <label>Departamento</label>

          <select class="form-control" required="" style="width:100%" name="departamento_id" id="departamento">
            <option value="<?php echo e($cotizaciones->departamento->id); ?>"><?php echo e($cotizaciones->departamento->nombre); ?></option>
            <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($departamento->id); ?>"><?php echo e($departamento->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3"id="natural">
          <label >Municipio</label>
          <select class="form-control" required="" style="width:100%" name="municipio" id="municipio">
            <option value="<?php echo e($municipio->id); ?>"><?php echo e($municipio->nombre); ?></option>
            <option value=""></option>
          </select>
        </div>
      </div>



      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <center> <h3>Detalle de la cotización</h3> </center>
        <div class="col-md-3">
          <label>Formas de pago :</label>
          <select name="formas_pago" style="width:100%" required>
            <option value="<?php echo e($cotizaciones->formas_pago); ?>"><?php echo e($cotizaciones->formas_pago); ?></option>
            <option value="Anticipo 100%">Anticipo 100%</option>
            <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
            <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
            <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
            <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
          </select>
        </div>
        <div class="col-md-3">
          <label>Tiempo de ejecución</label>
          <input type="text"  class="form-control" name="tiempo" value="<?php echo e($cotizaciones->tiempo); ?>">
        </div>
        <div class="col-md-3">
          <label>Tiempo de entrega de dictámenes</label>
          <input type="text"  class="form-control" name="entrega" value="<?php echo e($cotizaciones->entrega); ?>">
        </div>
      </div>

      <div class="col-md-12" style="margin-top:20px; margin-bottom:20px">
        <div class="col-md-3">
          <label>Número  de visitas contratadas</label>
          <input type="text"  class="form-control" name="visitas" value="<?php echo e($cotizaciones->visitas); ?>">
        </div>
        <div class="col-md-3">
          <label>Validez de la oferta</label>
          <input type="text" class="form-control" name="validez" value="<?php echo e($cotizaciones->validez); ?>">
        </div>
      </div>

    </div>
  </section>
    <h3>Paso 2</h3>
      <section>
    <div class="box-body" style="width: 110%">
      <?php if(count($mts) == 0): ?>
        <input type="hidden"  name="distribucion" value="distribucion"  >
      <?php else: ?>
      <center> <h3>Alcance: proceso de distribución en MT</h3> </center>

        <?php $__currentLoopData = $mts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row quitar51" id="quitar51" >
            <div class="col-md-12"  style="margin-bottom: 10px;">
            </div>
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="hidden"  name="distribucion[id][]" value="<?php echo e($mt->id); ?>"  >
                  <center class="separar"><label >Descripción</label></center>
                  <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en MT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <center class="separar"><label >Tipo</label></center>
                  <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                    <option value="<?php echo e($mt->tipo); ?>"><?php echo e($mt->tipo); ?></option>
                    <option value="Aérea">Tipo Aérea</option>
                    <option value="Subterránea">Tipo subterránea</option>
                  </select>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Nivel de tensión (KV) </label></center>
                  <select class="form-control tipo2 tension" name="distribucion[nivel_tension_dis][]" style="width:100%" id="kv">
                    <option value="<?php echo e($mt->nivel_tension); ?>"><?php echo e($mt->nivel_tension); ?></option>
                    <option value="13,2">13,2</option>
                    <option value="13,4">13,4</option>
                    <option value="13,8">13,8</option>
                    <option value="No aplica">No aplica</option>
                  </select>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Longitud de red (mts.)</label></center>
                  <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="<?php echo e($mt->cantidad); ?>" name="distribucion[cantidad_dis][]">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Apoyos o estructuras</label></center>
                  <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" value="<?php echo e($mt->apoyos); ?>" name="distribucion[apoyos_dis][]">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <center class="separar"><label >Cajas de inspección</label></center>
                  <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" value="<?php echo e($mt->cajas); ?>" name="distribucion[cajas_dis][]">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <center class="separar"><label >Notas</label></center>
                  <input type="text" class="form-control" placeholder= "Notas" value="<?php echo e($mt->notas); ?>" name="distribucion[notas_dis][]">
                </div>
              </div>
              <div class="col-md-1 tblprod11" >
                <div class="form-group">
                  <center class="separar"></center>
                  <a class="btn btn-primary eliminar" id="del-<?php echo e($mt->id); ?>" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>
                  <script type="text/javascript">
                    $('#del-'+<?php echo e($mt->id); ?>).click(function(e){
                      e.preventDefault();
                      p = confirm('¿esta seguro de eliminar?');
                      if (p) {
                        $.get("<?php echo e(url('deletedistri')); ?>/<?php echo e($mt->id); ?>",function(data){

                        });

                      }
                    });
                    $(document).on("click",".eliminar",function( event ) {
                      $(this).closest("#quitar51").remove();
                         return false;
                    });
                  </script>
                </div>
              </div>
          </div>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <?php if(count($transformaciones) == 0): ?>
        <input type="hidden"  name="transformacion" value="transformacion"  >
      <?php else: ?>
      <center> <h3>Alcance: proceso de transformación</h3> </center>

      <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row quitar50" id="quitar50">
            <input type="hidden" id="nivel" name="valor" value="<?php echo e($transfor->nivel_tension); ?>">
          <div class="col-md-12">
            <div class="col-md-3">
              <input type="hidden"  name="transformacion[id][]" value="<?php echo e($transfor->id); ?>"  >
              <div class="form-group">
                <center class="separar"><label >Descripción</label></center>
                <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Tipo</label></center>
                <select class="form-control tipo" name="transformacion[tipo][]" style="width:100%">
                  <option value="<?php echo e($transfor->tipo); ?>"><?php echo e($transfor->tipo); ?></option>
                  <option value="Tipo poste">Tipo poste</option>
                  <option value="Tipo interior">Tipo interior</option>
                  <option value="Tipo pedestal/jardin">Tipo pedestal/jardin</option>
                  <option value="Tipo patio">Tipo Patio</option>
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Nivel de tensión (KV)  </label></center>
                <select class="form-control tipo tension2" name="transformacion[nivel_tension][]" style="width:100%" id="kv">
                  <option value="<?php echo e($transfor->nivel_tension); ?>"><?php echo e($transfor->nivel_tension); ?></option>
                  <option value="13,2">13,2</option>
                  <option value="13,4">13,4</option>
                  <option value="13,8">13,8</option>
                  <option value="No aplica">No aplica</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Capacidad (KVA)</label></center>
                  <input type="text" class="form-control capacidad" placeholder="Capacidad"   value="<?php echo e($transfor->capacidad); ?>" name="transformacion[capacidad][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cantidad</label></center>
                <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" value="<?php echo e($transfor->cantidad); ?>"  name="transformacion[cantidad][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Refrigeración </label></center>
                <select class="form-control" name="transformacion[tipo_refrigeracion][]" style="width:100%">
                  <option value="<?php echo e($transfor->tipo_refrigeracion); ?>"><?php echo e($transfor->tipo_refrigeracion); ?></option>
                  <option value="Seco">Seco</option>
                  <option value="Aceite">Aceite</option>
                </select>
              </div>
            </div>
            <div class="col-md-1 tblprod11" >
              <div class="form-group">
                <center class="separar"></center>
                <a class="btn btn-primary eliminar2" id="del-<?php echo e($transfor->id); ?>" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>
                <script type="text/javascript">
                  $('#del-'+<?php echo e($transfor->id); ?>).click(function(e){
                    e.preventDefault();
                    p = confirm('¿esta seguro de eliminar?');
                    if (p) {
                      $.get("<?php echo e(url('deletetransfor')); ?>/<?php echo e($transfor->id); ?>",function(data){

                      });

                    }
                  });
                  $(document).on("click",".eliminar2",function( event ) {
                    $(this).closest("#quitar50").remove();
                       return false;
                  });
                </script>
              </div>
            </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(count($bts) == 0): ?>
      <input type="hidden"  name="distribucion" value="distribucion"  >
    <?php else: ?>
    <center> <h3>Alcance: proceso de distribución en BT</h3> </center>

      <?php $__currentLoopData = $bts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row quitar51" id="quitar51" >
          <div class="col-md-12"  style="margin-bottom: 10px;">
          </div>
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden"  name="distribucion[id][]" value="<?php echo e($bt->id); ?>"  >
                <center class="separar"><label >Descripción</label></center>
                <input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en BT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Tipo</label></center>
                <select class="form-control tipo2" name="distribucion[tipo_dis][]" style="width:100%" id="tipo">
                  <option value="<?php echo e($bt->tipo); ?>"><?php echo e($bt->tipo); ?></option>
                  <option value="Aérea">Tipo Aérea</option>
                  <option value="Subterránea">Tipo subterránea</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Nivel de tensión (KV) </label></center>
                <select class="form-control tipo2" name="distribucion[nivel_tension_dis][]" style="width:100%" id="tension">
                  <option value="<?php echo e($bt->nivel_tension); ?>"><?php echo e($bt->nivel_tension); ?></option>
                  <option value="110-220">110-220</option>
                  <option value="220-240">220-240</option>
                  <option value="No aplica">No aplica</option>
                </select>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Longitud de red (mts.)</label></center>
                <input type="text" class="form-control cantidad2" placeholder= "Cantidad" value="<?php echo e($bt->cantidad); ?>" name="distribucion[cantidad_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Apoyos o estructuras</label></center>
                <input type="text" id="apoyos" class="form-control" placeholder= "Cantidad" value="<?php echo e($bt->apoyos); ?>" name="distribucion[apoyos_dis][]">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <center class="separar"><label >Cajas de inspección</label></center>
                <input type="text" id="cajas" class="form-control" placeholder= "Cantidad" value="<?php echo e($bt->cajas); ?>" name="distribucion[cajas_dis][]">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <center class="separar"><label >Notas</label></center>
                <input type="text" class="form-control" placeholder= "Notas" value="<?php echo e($bt->notas); ?>" name="distribucion[notas_dis][]">
              </div>
            </div>
            <div class="col-md-1 tblprod11" >
              <div class="form-group">
                <center class="separar"></center>
                <a class="btn btn-primary eliminar3" id="del-<?php echo e($bt->id); ?>" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>
                <script type="text/javascript">
                  $('#del-'+<?php echo e($bt->id); ?>).click(function(e){
                    e.preventDefault();
                    p = confirm('¿esta seguro de eliminar?');
                    if (p) {
                      $.get("<?php echo e(url('deletedistri')); ?>/<?php echo e($bt->id); ?>",function(data){

                      });

                    }
                  });
                  $(document).on("click",".eliminar3",function( event ) {
                    $(this).closest("#quitar51").remove();
                       return false;
                  });
                </script>
              </div>
            </div>

      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(count($pu_finales) == 0): ?>
      <input type="hidden"  name="pu_final" value="pu_final"  >
    <?php else: ?>
    <center> <h3>Alcance: proceso de uso final</h3> </center>

      <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row quitar52" id="quitar52">
          <div class="col-md-12">
          </div>
          <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <input type="hidden"  name="pu[id][]" value="<?php echo e($pu->id); ?>" >
              <center><label >Descripción</label></center>
              <select class="form-control desc3"name="pu_final[descripcion_pu][]" style="width:100%" id="instalacion">
                <option value="<?php echo e($pu->descripcion); ?>"><?php echo e($pu->descripcion); ?></option>
                <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
                <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
                <option value="Inspección RETIE proceso uso final industrial">Inspección RETIE proceso uso final industrial</option>
              </select>
            </div>
          </div>
          <?php if( $pu->estrato == null): ?>
          <div class="col-md-2 " id="torres">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">
                <option value="<?php echo e($pu->tipo); ?>"><?php echo e($pu->tipo); ?></option>

              </select>
            </div>
          </div>
          <?php else: ?>
          <div class="col-md-2 " id="torre">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control tipo3" name="pu_final[tipo_pu][]" style="width:100%" id="tipo3">
                <option value="<?php echo e($pu->tipo); ?>"><?php echo e($pu->tipo); ?></option>

              </select>
            </div>
          </div>
          <?php endif; ?>

          <?php if( $pu->torres == null): ?>
          <?php else: ?>
          <div class="col-md-1 " id="borrar">
            <div class="form-group">
              <center><label >#Torres</label></center>
              <input type="text" class="form-control torre" value="<?php echo e($pu->torres); ?>" placeholder= "Cantidad" name="pu_final[torres][]">
            </div>
          </div>
          <?php endif; ?>
          <?php if( $pu->estrato == null): ?>
          <?php else: ?>
          <div class="col-md-2" id="estrato">
            <div class="form-group">
              <center><label >Estrato</label></center>
              <select class="form-control"name="pu_final[estrato_pu][]" style="width:100%">
                <option value="<?php echo e($pu->estrato); ?>"><?php echo e($pu->estrato); ?></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
          <?php endif; ?>
          <div class="col-md-1">
            <div class="form-group">
              <center><label >Cantidad</label></center>
              <input type="text" class="form-control cantidad3" value="<?php echo e($pu->cantidad); ?>" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <center><label >m²</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" value="<?php echo e($pu->metros); ?>" name="pu_final[metros_pu][]">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <center><label >KVA</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" value="<?php echo e($pu->kva); ?>" name="pu_final[kva_pu][]">
            </div>
          </div>
          <div class="col-md-1 tblprod11" >
            <div class="form-group">
              <br>
              <a class="btn btn-primary eliminar4" id="del-<?php echo e($pu->id); ?>" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>
              <script type="text/javascript">
                $('#del-'+<?php echo e($pu->id); ?>).click(function(e){
                  e.preventDefault();
                  p = confirm('¿esta seguro de eliminar?');
                  if (p) {
                    $.get("<?php echo e(url('deletepu')); ?>/<?php echo e($pu->id); ?>",function(data){

                    });

                  }
                });
                $(document).on("click",".eliminar4",function( event ) {
                  $(this).closest("#quitar52").remove();
                     return false;
                });
              </script>
            </div>
          </div>

        </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <div class="col-md-12">
        <center> <h3>Observaciones</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" ><?php echo e($cotizaciones->observaciones); ?></textarea>
      </div>
    </div>


</section>
  <h3>Paso 3</h3>
    <section>

     <table class="table table-bordered tabla">
       <tr>
         <th Colspan="5"><center><label> Cotización</label></center></th>
       </tr>
       <tr>
         <th><center><label> Item</label></center></th>
         <th><center><label> Descripcion del alcance</label></center></th>
         <th><center><label> Cantidad</label></center></th>
         <th><center><label> Valor unitario</label></center></th>
         <th><center><label> Valor</label></center></th>
         <th><center><label> <button type="button" class="btn btn-primary generar" style="background-color: #33579A; border-color:#33579A;" name="button">Generar tabla para precios</button></label></center></th>
       </tr>
       <input type="hidden"  value="<?php echo e($datos1); ?>" class="datos1">
       <input type="hidden"  value="<?php echo e($datos2); ?>" class="datos2">
       <input type="hidden"  value="<?php echo e($datos3); ?>" class="datos3">

     </table>
   </section>
   </div>
   <?php echo Form::close(); ?>



  </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>


<script type="text/javascript">
var validar = 0;
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

$(function() {
    var count = 1;

   $(".generar").on("click",function( event ) {
      count++;
      validar = 1;
      var x= $().val();
      var valor_multi = 0;
      var valor_multi_dis = 0;
      var valor_multi_pu = 0;
      var operador1=0;
      var acumu1=0;
      var operador2=0;
      var acumu2=0;
      var operador3=0;
      var acumu3=0;
      var datos = JSON.parse($(".datos1").val())
      var datos2 = JSON.parse($(".datos2").val())
      var datos3 = JSON.parse($(".datos3").val())
      $.each(datos, function(i,item){
            datos[i];
            valor_multi = valor_multi+datos[i].valor_total;


       })
       $.each(datos2, function(i,item){
             datos2[i];
             valor_multi_dis = valor_multi_dis+datos2[i].valor_total;

        })
        $.each(datos3, function(i,item){
              datos3[i];
              valor_multi_pu = valor_multi_pu+datos3[i].valor_total;
         })
    $('.actualizar').remove();


    $(".quitar50").each(function(i){

          var cantidad =$(this).find(".cantidad").val();
          var desc =$(this).find(".desc").val();
          var tipo =$(this).find(".tipo").val();
          var capacidad =$(this).find(".capacidad").val();
          var nFilas = $(".tabla tr").length - 1;


          if (cantidad != '' && desc!= '' && capacidad!='' && tipo!='') {
            operador1 = cantidad * datos[i].valor_uni;
            acumu1 = acumu1+ operador1;
            $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc+' - '+tipo+' de '+capacidad+' KVA'+'</td><td class="cant">'+cantidad+
            '</td><td><input type="text" class="form-control valor_uni" value="'+addCommas(datos[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni][]" required=""></td>'+' '+
            '<td><input type="text" class="form-control valor_multi" placeholder= "Valor" value="'+addCommas(operador1)+'" name="valores[valor_multi][]" required="" readonly ><input type="hidden"  value="'+datos[i].id+'"  name="valores[id][]"></td></tr>'+' '+
            '');

              event.preventDefault();

              $('.valor_uni').keyup(function(){
                var valor_uni = $(this).val().replace(/,/g,"");
                var cantidad = $(this).parent().parent().find(".cant").text();
                var resultado= valor_uni * cantidad;



                $(this).parent().parent().find('.valor_multi').val(addCommas(Math.round(resultado)));
                 valor_multi = 0;

                $(".valor_multi").each(function(i){
                       valor_multi = valor_multi + parseFloat($(this).val().replace(/,/g,"")) ;

                       var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                       var iva = subtotal*0.19;
                       var total = subtotal+iva;

                       $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                       $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));
                  });

                });
          }

      });


      $(".quitar51").each(function(i){

            var cantidad2 =$(this).find(".cantidad2").val();
            var desc2 =$(this).find(".desc2").val();
            var tipo2 =$(this).find(".tipo2").val();
            var nFilas = $(".tabla tr").length - 1;
            if (cantidad2 != '' && desc2!= '' && tipo2!='') {
              operador2 = datos2[i].valor_uni;
              acumu2 = acumu2+ operador2;
              $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td name="detalles2">'+desc2+' - '+tipo2+'</td><td>'+cantidad2+' mts.'+
              '</td><td><input type="text" class="form-control valor_uni_dis"  value="'+addCommas(datos2[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_dis][]" required="">'+' '+
              '</td><td><input type="text" class="form-control valor_multi_dis" placeholder= "Valor"  value="'+addCommas(operador2)+'" name="valores[valor_multi_dis][]" required="" readonly ><input type="hidden"  value="'+datos2[i].id+'"  name="valores[id_dis][]"></td></tr>'+' '+
              '');


                event.preventDefault();

                $('.valor_uni_dis').keyup(function(){

                  var valor_uni_dis = $(this).val().replace(/,/g,"");
                  var resultado2= valor_uni_dis;
                  $(this).parent().parent().find('.valor_multi_dis').val(addCommas(Math.round(resultado2)));
                  valor_multi_dis = 0;

                 $(".valor_multi_dis").each(function(i){
                        valor_multi_dis = valor_multi_dis + parseFloat($(this).val().replace(/,/g,"")) ;
                        var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                        var iva = subtotal*0.19;
                        var total = subtotal+iva;

                        $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                        $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));

                   });
                  });
            }
        });

        $(".quitar52").each(function(i){

              var cantidad3 =$(this).find(".cantidad3").val();
              var desc3 =$(this).find(".desc3").val();
              var tipo3 =$(this).find(".tipo3").val();
              var torre =$(this).find(".torre").val();
              var nFilas = $(".tabla tr").length - 1;

              if (cantidad3 != '' && desc3!= '' && tipo3!='') {
                operador3 = cantidad3 *datos3[i].valor_uni;
                acumu3 = acumu3+ operador3;
                $('.tabla tr:last').after('<tr class="actualizar"><td>'+nFilas+'</td><td>'+desc3+' - '+tipo3+'</td><td class="cant3">'+cantidad3+
                '</td><td><input type="text" class="form-control valor_uni_pu"  value="'+addCommas(datos3[i].valor_uni)+'" placeholder= "Valor" onkeyup="mascara(this,cpf)" name="valores[valor_uni_pu][]" required=""></td>'+' '+
                '<td><input type="text" class="form-control valor_multi_pu" placeholder= "Valor"  value="'+addCommas(operador3)+'" name="valores[valor_multi_pu][]" required="" readonly > <input type="hidden"  value="'+datos3[i].id+'"  name="valores[id_pu][]"></td></tr>'+' '+
                '');
                  event.preventDefault();

                  $('.valor_uni_pu').keyup(function(){
                    var valor_uni_pu = $(this).val().replace(/,/g,"");
                    var cantidad3 = $(this).parent().parent().find(".cant3").text();
                    var resultado3= valor_uni_pu * cantidad3;
                    $(this).parent().parent().find('.valor_multi_pu').val(addCommas(Math.round(resultado3)));
                    valor_multi_pu = 0;

                     $(".valor_multi_pu").each(function(i){
                          valor_multi_pu = valor_multi_pu + parseFloat($(this).val().replace(/,/g,""));
                          var subtotal=  parseFloat(valor_multi_dis)+parseFloat(valor_multi)+parseFloat(valor_multi_pu);
                           var iva = subtotal*0.19;
                           var total = subtotal+iva;

                          $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').text(addCommas(Math.round(subtotal)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.subtotal').val(addCommas(Math.round(subtotal)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.iva').text(addCommas(Math.round(iva)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.iva').val(addCommas(Math.round(iva)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.total').text(addCommas(Math.round(total)));
                          $(this).parent().parent().parent().parent().parent().parent().find('.total').val(addCommas(Math.round(total)));
                       });

                    });
              }


          });


    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Subtotal</label></td><td><label class="subtotal">$<?php echo e(number_format($cotizaciones->subtotal,0)); ?></label><input type="hidden" class="form-control subtotal" placeholder= "Valor" value="<?php echo e($cotizaciones->subtotal); ?>"  name="subtotal"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>IVA 19%</label></td><td><label class="iva">$<?php echo e(number_format($cotizaciones->iva,0)); ?></label><input type="hidden" class="form-control iva" placeholder= "Valor"  name="iva" value="<?php echo e($cotizaciones->iva); ?>"  required="" readonly ></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Total</label></td><td><label class="total">$<?php echo e(number_format($cotizaciones->total,0)); ?></label><input type="hidden" class="form-control total" placeholder= "Valor" value="<?php echo e($cotizaciones->total); ?>" name="total"  required="" readonly></td></tr>');
    $('.tabla tr:last').after('<tr class="actualizar"><td Colspan="3"></td><td><label>Costo adicional de visita por dia si se requiere:</label></td><td><input type="text" class="form-control adici" placeholder= "Valor" onkeyup="mascara(this,cpf)" value="<?php echo e($cotizaciones->adicional); ?>" name="adici"  required="" ></td></tr>');
    $('.tabla tr:last').after('<input type="hidden" class="form-control valor_multi actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_dis actualizar"  value="0"  >');
    $('.tabla tr:last').after('<input type="hidden" class="form-control  valor_multi_pu actualizar"  value="0"  >');
    var subtot= acumu1+acumu2+acumu3;
    var iva = subtot*0.19;
    var total = subtot+iva;
    $('.subtotal').text(addCommas(Math.round(subtot)));
    $('.subtotal').val(addCommas(Math.round(subtot)));
    $('.iva').text(addCommas(Math.round(iva)));
    $('.iva').val(addCommas(Math.round(iva)));
    $('.total').text(addCommas(Math.round(total)));
    $('.total').val(addCommas(Math.round(total)));
   });

});



$(document).ready(function(){

  var  tipo = $('#tipo').val();


  if (tipo == 'Aérea') {
    $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
    $(this).parent().parent().parent().find('#cajas').val('N.A');
    $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

  }
    else if (tipo == 'Subterránea') {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
      $(this).parent().parent().parent().find('#apoyos').val('N.A');
    }
    else {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
    }


  $('#cliente').change(function(){
      var valorCambiado =$(this).val();
      if((valorCambiado == "1")){
        $('#natural').css('display','block');
         $('#juridica').css('display','none');
         $("#select-natural").prop('required',true);
         $("#juri").prop('required',false);
       }
       else if(valorCambiado == "2")
       {
         $('#juridica').css('display','block');
          $('#natural').css('display','none');
          $("#juri").prop('required',true);
          $("#select-natural").prop('required',false);

       }
  });

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

$(document).on('change','#tipo',function(){

  var  tipo = $(this).val();

  if (tipo == 'Aérea') {
    $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
    $(this).parent().parent().parent().find('#cajas').val('N.A');
    $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

  }
    else if (tipo == 'Subterránea') {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
      $(this).parent().parent().parent().find('#apoyos').val('N.A');
    }
    else {
      $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
      $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
    }


});



$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

  if (instalacion == 'Inspección RETIE proceso uso final residencial') {
    $(this).parent().parent().parent().find("#tipo3").html('');

    $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Casa">Casa</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Apartamentos">Apartamentos</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Zona común">Zona común</option>');
    $(this).parent().parent().parent().find("#tipo3").append('<option value="Punto fijo">Punto fijo</option>');

  }
    else if (instalacion == 'Inspección RETIE proceso uso final comercial') {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Local comercial">Local comercial</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }
    else {
      $(this).parent().parent().parent().find("#tipo3").html('');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="">Seleccione...</option>');
      $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
    }

});

$(document).on('change','#instalacion',function(){

  var  instalacion = $(this).val();

    if(instalacion == 'Inspección RETIE proceso uso final residencial') {
      $(this).parent().parent().parent().find( "#torres" ).addClass( "torres" );
      $(this).parent().parent().parent().find( "#torre" ).addClass( "torre" );
      $('.torres').after(
          '<div class="col-md-2" id="estrato">'+' '+
            '<div class="form-group">'+' '+
              '<center><label >Estrato</label></center>'+' '+
              '<select class="form-control "name="pu_final[estrato_pu][]" style="width:100%">'+' '+
                '<option value="">Seleccione...</option>'+' '+
                '<option value="1">1</option>'+' '+
                '<option value="2">2</option>'+' '+
                '<option value="3">3</option>'+' '+
                '<option value="4">4</option>'+' '+
                '<option value="5">5</option>'+' '+
                '<option value="6">6</option>'+' '+
              '</select>'+' '+
            '</div>'+' '+
          '</div>');
          $(this).parent().parent().parent().parent().find( "#estrato" ).addClass( "borrar2" );
          $('.borrar2').remove();
          $('.torre').after(
              '<div class="col-md-2" id="estrato">'+' '+
                '<div class="form-group">'+' '+
                  '<center><label >Estrato</label></center>'+' '+
                  '<select class="form-control "name="pu_final[estrato_pu][]" style="width:100%">'+' '+
                    '<option value="">Seleccione...</option>'+' '+
                    '<option value="1">1</option>'+' '+
                    '<option value="2">2</option>'+' '+
                    '<option value="3">3</option>'+' '+
                    '<option value="4">4</option>'+' '+
                    '<option value="5">5</option>'+' '+
                    '<option value="6">6</option>'+' '+
                  '</select>'+' '+
                '</div>'+' '+
              '</div>');
          $("select").select2();
          $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );
          $(this).parent().parent().parent().find( "#torre" ).removeClass( "torre" );
    }
    else {
      $(this).parent().parent().parent().parent().find( "#estrato" ).addClass( "borrar2" );
      $('.borrar2').remove();
    }


});

$(document).on('change','#kv',function(){

  var  kv = $(this).val();

  if (kv == '13,2') {
    $('#nivel').val('13,2');
  }
    else if (kv == '13,4') {
      $('#nivel').val('13,4');
    }
    else if (kv == '13,8') {
      $('#nivel').val('13,8');
    }
    else {
      $('#nivel').val('No aplica');
    }
});


$(document).on('change','.tipo3',function(){

  var  tipo = $(this).val();

    if (tipo == 'Apartamentos') {
      $(this).parent().parent().parent().find( "#torres" ).addClass( "torres" );
      $(this).parent().parent().parent().find( "#torre" ).addClass( "torre" );
      $('.torres').after(
        '<div class="col-md-1 " id="borrar">'+' '+
          '<div class="form-group">'+' '+
            '<center><label >#Torres</label></center>'+' '+
              '<input type="text" class="form-control torre" value="" placeholder= "Cantidad" name="pu_final[torres][]">'+' '+
            '</div>'+' '+
          '</div>'
    );
    $(this).parent().parent().parent().parent().find( "#borrar" ).addClass( "borrar" );
    $('.borrar').remove();
    $('.torre').after(
      '<div class="col-md-1 " id="borrar">'+' '+
        '<div class="form-group">'+' '+
          '<center><label >#Torres</label></center>'+' '+
            '<input type="text" class="form-control torre" value="" placeholder= "Cantidad" name="pu_final[torres][]">'+' '+
          '</div>'+' '+
        '</div>'
  );

    $(this).parent().parent().parent().find( "#torres" ).removeClass( "torres" );
    $(this).parent().parent().parent().find( "#torre" ).removeClass( "torre" );

    }
    else {
      $(this).parent().parent().parent().parent().find( "#borrar" ).addClass( "borrar" );
      $('.borrar').remove();
    }
});

var form = $("#form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
      if (validar == 0) {
        alert('Presione el boton generar tabla para precios');
      }
      else {
        $("#form").submit();
      }

    }
});
</script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>