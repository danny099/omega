<style media="screen">
  .botoncito{
    width: 200px;
  }
  .div2{
    padding: 5px;
  }
  textarea{
    width:100%;
    resize: none;
  }
  select{
    width:100%;
  }

</style>
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
  $(function () {
    $("table").DataTable({
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
  }
 });
  });
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

      varIva = parseFloat(varMonto) / 1.19;
      document.getElementById("valor_contrato_inicial").value = addCommas(Math.round(varIva)) ;

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
    function addCommas2(nStr){
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




    $(document).on('change','#tipo',function(){

      var  tipo = $(this).val();

      if (tipo == 'Aérea') {
        $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
        $(this).parent().parent().parent().find('#cajas').val(0);
        $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

      }
        else if (tipo == 'Subterránea') {
          $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
          $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
          $(this).parent().parent().parent().find('#apoyos').val(0);
        }
        else {
          $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
          $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
        }


    });

    $(document).on('change','#desc',function(){

      var  desc = $(this).val();

      if (desc == 'Inspección RETIE proceso de distribución en MT') {
        $(this).parent().parent().parent().find("#tension").html('');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,2">13,2</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,4">13,4</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,8">13,8</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');

      }
        else {
          $(this).parent().parent().parent().find("#tension").html('');
          $(this).parent().parent().parent().find("#tension").append('<option value="110-220">110-220</option>');
          $(this).parent().parent().parent().find("#tension").append('<option value="220-240">220-240</option>');
          $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');
        }


    });


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

      $(document).ready(function($){
        $('#codigo_proyecto').inputmask('CPS-9999-999');
      });

      $('.antesiva').on('keyup',function(){
          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().parent().parent().find('.otrosi').val(addCommas2(Math.round(resultado)));



      });
      $('.valor').keyup(function(){
          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));


      });

      $('.valor_factura').on('keyup',function(){

          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));

          var retencionesporcen = $(this).parent().parent().parent().find('.retencionesporcen').val().replace(/,/g,".");
          var valor2 = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
          var resultado2 = valor2*retencionesporcen/100;
          $(this).parent().parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado2)));

          var retegarantiaporcen = $(this).parent().parent().parent().find('.retegarantiaporcen').val().replace(/,/g,".");
          var valor3 = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado3 = valor3*retegarantiaporcen/100;
          $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado3)));


          var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
          var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
          var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
          var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado4 =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
          $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado4)));


      });




      $('.retencionesporcen').keyup(function(){
        var retencionesporcen = parseFloat($(this).val().replace(/,/g,"."));
        var valor = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
        var resultado = valor*retencionesporcen/100;
        $(this).parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado)));
      });
      $('.retencionesporcen').change(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });

      $('.amortizacion').keyup(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
        });

      $('.polizas').keyup(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });
      $('.retegarantiaporcen').keyup(function(){
        var retegarantiaporcen = parseFloat($(this).val().replace(/,/g,"."));
        var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado = valor*retegarantiaporcen/100;
        $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado)));
      });
      $('.retegarantiaporcen').change(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });

      $('.retencionesporcen').focus(function(){
        var retenciones = parseInt($(this).val(""));
      });
      $('.amortizacion').focus(function(){
        var amortizacion = parseInt($(this).val(""));
      });
      $('.polizas').focus(function(){
        var polizas = parseInt($(this).val(""));
      });
      $('.retegarantiaporcen').focus(function(){
        var retegarantia = parseInt($(this).val(""));
      });


  </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>

  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
    <li><a href="<?php echo e(url('administrativas')); ?>">Administrativa</a></li>
    <li class="active">Editar Proyecto</li>
  </ol>

  <div class="box box-primary">
    <div class="box-header with-border">
      <center><h3 >Datos del proyecto</h3></center>
    </div>

    <?php if(Session::has('message')): ?>
      <div class="" id="alert">
        <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
        <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-<?php echo e(Session::get('class')); ?>">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo e(Session::get('message')); ?>

        </div>
      </div>
    <?php endif; ?>

    <div class="formulario_principal">
      <?php echo Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]); ?>

      <?php echo e(csrf_field()); ?>

        <div class="box-body">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('codigo_proyecto', 'Código del proyecto:'); ?>

              <?php echo Form::text('codigo_proyecto', null, ['class' => 'form-control' , 'required' => 'required', 'pattern'=>'[A-Z]{3}[-]{1}[0-9]{4}[-]{1}[0-9]{3}']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('nombre', 'Nombre del proyecto'); ?>

              <?php echo Form::text('nombre_proyecto', null, ['class' => 'form-control' , 'required' => 'required']); ?>

            </div>
            <div class="form-group">
              <?php echo Form::label('fecha_contrato', 'Fecha del contrato:'); ?>

              <?php echo Form::date('fecha_contrato', null, ['class' => 'form-control' , 'required' => 'required']); ?>

            </div>
            <?php if(empty($administrativas->juridica->id )): ?>
              <div class="form-group">
                <label >Tipo de régimen</label>
                <select class="form-control" name="tipo_regimen" id="cliente" required="">
                  <option value="1">Persona natural</option>
                  <option value="2">Persona jurídica</option>
                </select>
              </div>
              <div class="form-group" id="natural">
                <label >Persona natural</label>
                <select class="form-control select2" name="cliente_id" style="width: 100%;" id="select-natural">
                  <option value="<?php echo e($administrativas->cliente->id); ?>"><?php echo e($administrativas->cliente->nombre); ?></option>
                  <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group" style="Display:none" id="juridica">
                <label>Persona jurídica</label>
                <select class="form-control" name="juridica_id" style="width: 100%;" >
                  <option value="">Seleccione</option>
                  <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            <?php endif; ?>
            <?php if(empty($administrativas->cliente->id )): ?>
              <div class="form-group">
                <label>Tipo Regimen</label>
                <select class="form-control" name="tipo_regimen" id="cliente" required="">
                  <option value="2">Persona jurídica</option>
                  <option value="1">Persona natural</option>
                </select>
              </div>
              <div class="form-group" style="Display:none" id="natural">
                <label >Persona natural</label>
                <select class="form-control select2" style="Display:none;width: 100%;" name="cliente_id" id="select-natural">
                  <option value="">Seleccione</option>
                  <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($cliente->id); ?>"><?php echo e($cliente->nombre); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group"  id="juridica">
                <label >Persona jurídica</label>
                <select class="form-control" name="juridica_id" style="width: 100%;" >
                  <option value="<?php echo e($administrativas->juridica->id); ?>"><?php echo e($administrativas->juridica->razon_social); ?></option>
                  <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($juridica->id); ?>"><?php echo e($juridica->razon_social); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            <?php endif; ?>
            <div class="form-group">
              <label >Departamento</label>
              <select class="form-control" required="" name="departamento_id" id="departamento">
                <option value="<?php echo e($administrativas->departamento->id); ?>"><?php echo e($administrativas->departamento->nombre); ?></option>
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
          <div class="col-md-4">
            <div class="form-group">
              <label >Tipo de zona</label>
              <select class="form-control" required="" name="zona">
                <option value="<?php echo e($administrativas->tipo_zona); ?>"><?php echo e($administrativas->tipo_zona); ?></option>
                <option value="Urbana">Urbana</option>
                <option value="Rural">Rural</option>
                <option value="Urbana/Rural">Urbana/Rural</option>
              </select>
            </div>
            <div class="form-group">
              <label >Valor contrato final</label>
              <input type="text" class="form-control" min="0" id="fin" autocomplete="off" onkeyup="calcular(); mascara(this,cpf)"  onkeyup="mascara(this,cpf)"  onpaste="return false" required="ingrese así sea un cero" placeholder= "Valor final" name="contrato_final" value="<?php echo e(number_format($administrativas->valor_contrato_final,0)); ?>">
            </div>
            <div class="form-group">
              <label >Valor IVA</label>
              <input type="text" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor IVA" name="iva" value="<?php echo e(number_format($administrativas->valor_iva,0)); ?>">
            </div>
            <div class="form-group">
              <?php echo Form::label('valor_contrato_inicial', 'Valor antes de IVA'); ?>

              <?php echo Form::text('valor_contrato_inicial',  $administrativas->valor_contrato_inicial , ['class' => 'form-control' ,'readonly', 'required' => 'required', 'min'=>'0']); ?>

            </div>
            <div class="form-group">
              <label >Plan de pago</label>
              <select name="formas_pago" style="width:100%" required>
                <option value="<?php echo e($administrativas->formas_pago); ?>"><?php echo e($administrativas->formas_pago); ?></option>
                <option value="Anticipo 100%">Anticipo 100%</option>
                <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
                <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
                <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
                <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="col-md-12">
              <center><label >Editar/eliminar</label></center>
            </div>
            <?php if(count($adicionales) == 0): ?>
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled>Valor adicional</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="<?php echo e(route('adicionales.edit', $administrativas->id)); ?>" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal2" style="background-color: #33579A; border-color:#33579A;">Valor adicional</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($otrosis) == 0): ?>
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Otro sí</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal3" style="background-color: #33579A; border-color:#33579A;">Otro sí</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($pu_finales) == 0): ?>
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled>Proceso uso final</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="<?php echo e(route('pu_final.edit', $administrativas->id)); ?>" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal4" style="background-color: #33579A; border-color:#33579A;">Proceso uso final</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($distribuciones) == 0 ): ?>
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Alcance distribución</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="<?php echo e(route('distribuciones.edit', $administrativas->id)); ?>" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal5" style="background-color: #33579A; border-color:#33579A;">Alcance distribución</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($transformaciones) == 0): ?>
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled >Alcance transformación</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="<?php echo e(route('transformaciones.edit', $administrativas->id)); ?>" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal6" style="background-color: #33579A; border-color:#33579A;" >Alcance transformación</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($facturas) == 0): ?>
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Facturas</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal7" style="background-color: #33579A; border-color:#33579A;">Facturas</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($cuenta_cobros) == 0): ?>
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Cuentas de cobro</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="<?php echo e(route('cuenta_cobros.edit', $administrativas->id)); ?>" class="btn btn-primary botoncito " data-toggle="modal" data-target="#myModal8"style="background-color: #33579A; border-color:#33579A;">Cuentas de cobro</a></center>
              </div>
            <?php endif; ?>
            <?php if(count($consignaciones) == 0): ?>
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Consignaciones</a></center>
              </div>
            <?php else: ?>
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal9" style="background-color: #33579A; border-color:#33579A;">Consignaciones</a></center>
              </div>
            <?php endif; ?>
            <div class="col-md-12 div2">
              <center><a href="#myModal10" class="btn btn-primary botoncito" data-toggle="modal" data-target="" style="background-color: #33579A; border-color:#33579A;">Crear observación</a></center>
            </div>
          </div>
          <div class="col-md-12">

            <div class="col-md-12">
              <div class="col-md-1">
                <div class="form-group">
                  <label>#</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Observaciones</label>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Fecha</label>
                </div>
              </div>
            </div>
            <?php $__currentLoopData = $observaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $obs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-12">
                <div class="col-md-1">
                  <div class="form-group">
                    <td><?php echo e($key+1); ?></td>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <td><?php echo e($obs->observacion); ?></td>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <td><?php echo e(date_format(new DateTime($obs->created_at), 'd-m-y')); ?></td>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </div>

        </div>
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>


      <?php echo Form::close(); ?>


      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal10"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <?php echo Form::open(['class'=>'form2','url' => 'observaciones']); ?>

              <?php echo e(csrf_field()); ?>

                <div class="box-body">

                  <br>
                  <div class="col-md-2">
                    <div class="form-group">
                      <?php echo Form::label('observacion', 'Observación'); ?>

                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <td><textarea  rows="4" cols="60" name="observacion" required=""></textarea></td>
                    </div>
                  </div>
                  <input type="hidden" name="administrativa_id" value="<?php echo e($administrativas->id); ?>">
                  <div class="box-footer">
                    <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Crear</button>
                  </div>
                </div>


              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      <!-- fin modal -->

      <div class="modal fade bs-example-modal-lg" id="myModal7"  role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg3" role="document">
          <div class="modal-content">

            <div class="box box-primary">
              <div class="box-header with-border">
                <center> <h3 class="box-title"> Editar factura</h3> </center>
              </div>
              <div class="box-body">
                <div class="col-md-12 well">
                    <table id="example" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Número factura</th>
                          <th>Fecha de la factura</th>
                          <th>Valor antes de IVA</th>
                          <th>IVA</th>
                          <th>Valor con IVA</th>
                          <th>Acciones</th>
                          <th>Alertas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($factura->num_factura); ?></td>
                          <td><?php echo e(date_format(new DateTime($factura->fecha_factura), 'd-m-y')); ?></td>
                          <td>$<?php echo e(number_format($factura->valor_factura,0)); ?></td>
                          <td>$<?php echo e(number_format($factura->iva,0)); ?></td>
                          <td>$<?php echo e(number_format($factura->valor_total,0)); ?></td>
                          <td>
                            <a href="" data-toggle="modal" data-target="#myModal20-<?php echo e($key); ?>"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                            <a href="<?php echo e(url('deletefactura')); ?>/<?php echo e($factura->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                            <!-- inicio modal 1 -->

                            <div class="modal fade" id="myModal20-<?php echo e($key); ?>" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"></h4>
                                  </div>
                                  <div class="modal-body">
                                    <?php echo $__env->make('facturas.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                  </div>
                                  <div class="modal-footer">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- fin modal -->
                          </td>
                          <td>
                            <?php if($factura->recuerdame == 1): ?>
                            <a title="Esta es la factura pendiente">
                              <i class="glyphicon glyphicon-alert" style="color: #ff2f00"></i>
                            </a>
                            <?php else: ?>

                            <?php endif; ?>

                          </td>

                        </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal2" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal3"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg3" role="document">
            <div class="modal-content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <center> <h3 class="box-title"> Editar otro si</h3> </center>
                </div>
                <div class="box-body">
                  <div class="col-md-12 well">

                      <table id="example" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Valor antes de IVA</th>
                            <th>IVA</th>
                            <th>Valor con IVA</th>
                            <th>Detalles</th>
                            <th>Acciones</th>
                            <th>Alertas</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $otrosis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $otro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td>$<?php echo e(number_format($otro->valor,0)); ?></td>
                            <td>$<?php echo e(number_format($otro->iva,0)); ?></td>
                            <td>$<?php echo e(number_format($otro->valor_tot,0)); ?></td>
                            <td><?php echo e($otro->detalles); ?></td>
                            <td>
                              <a href="<?php echo e(route('otrosi.edit', $otro->id)); ?>" data-toggle="modal" data-target="#myModal21-<?php echo e($key); ?>"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                              <a href="<?php echo e(url('deleteotrosi')); ?>/<?php echo e($otro->id); ?>" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                              <!-- inicio modal 1 -->

                              <div class="modal fade" id="myModal21-<?php echo e($key); ?>" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">

                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                      <?php echo $__env->make('otrosi.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>

                              </div>
                              <!-- fin modal -->
                            </td>
                            <td>
                              <?php if($otro->recuerdame == 1): ?>
                              <a title="Esta es la factura pendiente">
                                <i class="glyphicon glyphicon-alert" style="color: #f39c12"></i>
                              </a>
                              <?php else: ?>

                              <?php endif; ?>
                            </td>

                          </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>

                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      <!-- fin modal -->

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal4"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal5"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal6"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->

      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal8"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <?php echo $__env->make('cuenta_cobros.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal9"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <?php echo $__env->make('consignaciones.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>
        </div>
      <!-- fin modal -->

    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>