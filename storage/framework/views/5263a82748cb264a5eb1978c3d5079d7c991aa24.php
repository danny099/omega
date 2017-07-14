<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title><?php echo e($cotizaciones->codigo); ?></title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">

    <style media="screen">
      ul, img, table {
        page-break-inside: avoid;
      }
      .referencia, .comerciales, .inspeccionDoc,.pago, .referencia, .ocho, .inscricion {
        page-break-inside: avoid;
      }
      body{
        font-family: "Arial Narrow";
      	font-size: 12pt;
      	font-style: normal;
      	font-variant: normal;
      	font-weight: 500;
      	line-height: 15.4px;
        text-align: justify;
      }
      p{
        margin: 0;
        padding: 0;
      }
      .codigo{
        display: inline-block;
        float: left;
        text-align: center;
      }
      .entrada{
        display: inline-block;
      }
      .obj1{
        display: inline-block;
        }
      .obj2{
        display: inline-block;
        margin-left: 150px;
        margin-right: 80px;
      }


      .tx1{
        margin: 5px;
      }
      img{
        margin: 0;
        padding: 0;
      }
      .div2{
        padding: 0;
        margin-top: 50px;
      }
      .ttable{
        text-align: center;
      }
      #td{
        border-bottom: solid white;
      }
      #td2{
        border-top: solid white;
      }
      #td3{
        border-top: solid white;
      }
      table {
        border-collapse:collapse; border: none;
      }
      td {
        padding: 0;
      }

      @page  { margin: 100px 50px; }
      header { position: fixed; top: -60px; left: 0px; right: 0px; height: 100px;
            margin-top: 25px}
      footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
      .page-number:after {  content: counter(page) ; }

      /*p { page-break-after: always; }*/
      /*p:last-child { page-break-after: never; }*/

    </style>
  </head>
  <body>

    <header>
      <table class="table table-bordered " cellpadding="0" cellspacing="0">
        <tr>
          <td><center><img id="img" src="Certicol2.png" style="width:60px;"></center></td>
          <th><center>COTIZACIÓN</center></th>
          <td><center><span class="page-number">Pagina </span></center></td>
        </tr>
      </table>
    </header>
    <footer>
      <table class="table">
        <tr>
          <td id="td3"><center><span class="">Certicol_for_096 / Aprobado 09-05-2017 / Versión 01 </span></center></td>
        </tr>
      </table>
    </footer>

    <br>
    <br>
    <div class="div1">
      <div class="entrada">
        <p>Santiago de Cali</p>
        <p><?php echo e(date_format(new DateTime($cotizaciones->fecha), 'd-m-y')); ?></p>

      </div>
      <div class="codigo">
        <table class=" " align="right">
          <tr>
            <td colspan="2">Código de Cotización</td>
          </tr>
          <tr>
            <td><?php echo e($cotizaciones->codigo); ?></td>

          </tr>
        </table>
      </div>
      <br>
      <br>
      <div class="dirigido">
        <p><?php echo e($cotizaciones->dirigido); ?></p>
        <?php if(empty($clientes)): ?>
        <span>Razon social: <?php echo e($juridicas->razon_social); ?></span><br>
        <span>NIT: <?php echo e($juridicas->nit); ?></span><br>
        <span>Direccion: <?php echo e($juridicas->direccion); ?></span><br>
        <?php else: ?>
        <span>Nombre: <?php echo e($clientes->nombre); ?></span><br>
        <span>CC: <?php echo e($clientes->cedula); ?></span>
        <?php endif; ?>
      </div>
    </div>
    <br>
    <div class="div2">
      <p class="obj1">
        Objeto:
      </p>
      <p class="obj2" align="justify">
        Este Documento Constituye  la Oferta Técnica  y Económica  para la prestación de servicios
        de inspectoría  RETIE a las instalaciones eléctricas del proyecto <?php echo e($cotizaciones->nombre); ?> Ubicado
        en el Municipio de <?php echo e($municipios->nombre); ?> departamento del <?php echo e($departamentos->nombre); ?>.
      </p>
    </div>
      <br>

    <div class="div3">
      <p>Cordial Saludo:</p>
      <br>
      <div class="cordial">
          <?php
            $refer = html_entity_decode($saludo->detalles);
            echo $refer;
          ?>
      </div>
    </div>
      <br>
      <br>
    <div class="alcances">
      <p><b>1. ALCANCE DE LA INSPECCIÓN</b></p>
          <br>
      <?php if(count($transformaciones) == 0): ?>
      <?php else: ?>

      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="7" class="ttable">ALCANCE DE TRANSFORMACIÓN</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Nivel de Tensión</th>
            <th>Capacidad (KVA)</th>
            <th>Cantidad</th>
            <th>Tipo de Refrigeración</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($transfor->descripcion); ?></td>
              <td><?php echo e($transfor->tipo); ?></td>
              <td><?php echo e($transfor->nivel_tension); ?></td>
              <td><?php echo e($transfor->capacidad); ?></td>
              <td><?php echo e($transfor->cantidad); ?> Und</td>
              <td><?php echo e($transfor->tipo_refrigeracion); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <br>
      <?php endif; ?>

      <?php if(count($distribuciones) == 0): ?>
      <?php else: ?>
      <table class=" table table-bordered table-striped" style="page-break-before: avoid;">
        <tr>
          <th colspan="8" class="ttable">ALCANCE DE DISTRIBUCIÓN</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Nivel de Tensión</th>
            <th>Cantidad</th>
            <th>Apoyos</th>
            <th>Cajas</th>
            <th>Notas</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($distri->descripcion); ?></td>
              <td><?php echo e($distri->tipo); ?></td>
              <td><?php echo e($distri->nivel_tension); ?></td>
              <td><?php echo e($distri->cantidad); ?> mts.</td>
              <td><?php echo e($distri->apoyos); ?></td>
              <td><?php echo e($distri->cajas); ?></td>
              <td><?php echo e($distri->notas); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <br>
      <?php endif; ?>

      <?php if(count($pu_finales) == 0): ?>
      <?php else: ?>
      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="8" class="ttable">ALCANCE PROCESO USO FINAL</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Estrato</th>
            <th>Cantidad</th>
            <th>m²</th>
            <th>Kva</th>
            <th>Acometidas</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($pu->descripcion); ?></td>
              <td><?php echo e($pu->tipo); ?></td>
              <?php if( $pu->estrato == null ): ?>
                <td> N.A </td>
              <?php else: ?>
                <td><?php echo e($pu->estrato); ?></td>
              <?php endif; ?>
              <td><?php echo e($pu->cantidad); ?> Und</td>
              <td><?php echo e($pu->metros); ?></td>
              <td><?php echo e($pu->kva); ?></td>
              <td><?php echo e($pu->acometidas); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
    <div class="referencia">
      <p><b><?php echo e($referencia->nombre); ?></b></p>
      <br><br>

        <?php
          $refer = html_entity_decode($referencia->detalles);
          echo $refer;
        ?>

    </div>
    <br>
    <br>
    <div class="inspeccionDoc">
    <p><b><?php echo e($inicial->nombre); ?></b></p>

    <br><br>

      <?php
        $refer = html_entity_decode($inicial->detalles);
        echo $refer;
      ?>
    </div>
    <br>
    <br>
    <div class="inscricion">
    <p><b><?php echo e($inspeccion->nombre); ?></b></p>

      <?php
        $refer = html_entity_decode($inspeccion->detalles);
        echo $refer;
      ?>
    </div>
    <br>
    <br>
    <div class="referencia">
      <p><b>5. PROPUESTA ECONOMICA</b></p>
      <br>

      <table class="table table-bordered tabla">
        <tr>
          <th Colspan="4"><center><label> Cotización</label></center></th>
        </tr>
        <tr>
          <th><center><label> Ítem </label></center></th>
          <th><center><label> Descripción del alcance </label></center></th>
          <th><center><label> Cantidad </label></center></th>
          <th><center><label> Valor </label></center></th>
        </tr>
        <?php $i = 0; ?>
        <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <?php $i++ ?>
            <td><?php echo e($i); ?></td>
            <td>
              <p><?php echo e($trans->descripcion); ?> - <?php echo e($trans->tipo); ?> - Capacidad: <?php echo e($trans->capacidad); ?> KVA </p>
            </td>
            <td><?php echo e($trans->cantidad); ?> <?php echo e($trans->unidad); ?></td>

            <td id="td"></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <?php $i++ ?>
            <td><?php echo e($i); ?></td>
            <td>
              <p><?php echo e($distri->descripcion); ?> - <?php echo e($distri->tipo); ?></p>
            </td>
            <td><?php echo e($distri->cantidad); ?> <?php echo e($distri->unidad); ?></td>

            <td id="td2"></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <?php $i++ ?>
            <td><?php echo e($i); ?></td>
            <td>
              <p><?php echo e($pu->descripcion); ?> - <?php echo e($pu->tipo); ?></p>
            </td>
            <td><?php echo e($pu->cantidad); ?> <?php echo e($pu->unidad); ?></td>

            <td id="td2"></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td></td>
          <td colspan="2"><b>Valor de la Inspección</b></td>
          <td>$<?php echo e(number_format($total,0)); ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2"><b>IVA(19%)</b></td>
          <td>$<?php echo e(number_format($iva,0)); ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2"><b>Total</b></td>
          <td>$<?php echo e(number_format($valor_total,0)); ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2"><b>Costo adicional de visita por dia si se requiere:</b></td>
          <td>$<?php echo e($cotizaciones->adicional); ?></td>
        </tr>
        <!-- <td>
          <p> </p>
          <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <p><?php echo e($pu->descripcion); ?> - <?php echo e($pu->tipo); ?> +</p>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <p>Unidades de Vivienda</p>
        </td> -->

      </table>
    </div>
    <div class="comerciales">
      <p><b>6. CONDICIONES COMERCIALES</b></p>
      <br>
      <table class="table table-bordered tabla">
        <tr>
          <td>Forma de pago</td>
          <td><?php echo e($cotizaciones->formas_pago); ?></td>
        </tr>
        <tr>
          <td>Tiempo de ejecución</td>
          <td><?php echo e($cotizaciones->tiempo); ?></td>
        </tr>
        <tr>
          <td>Tiempo de entrega del dictamen</td>
          <td><?php echo e($cotizaciones->entrega); ?> una vez se encuentre la documentación  completa y no se tenga NC abiertas</td>
        </tr>
        <tr>
          <td>Número de visitas de inspección  contratadas</td>
          <td><?php echo e($cotizaciones->visitas); ?> </td>
        </tr>
        <tr>
          <td>Validez de la oferta</td>
          <td><?php echo e($cotizaciones->validez); ?> </td>
        </tr>
      </table>
    </div>

      <div class="pago">
        <p><b><?php echo e($pago->nombre); ?></b></p>
        <br>
        <?php
          $refer = html_entity_decode($pago->detalles);
          echo $refer;
        ?>
      </div>
    <div class="ocho">
      <div class="docu">
        <p><b><?php echo e($docu->nombre); ?></b></p>
        <?php
          $refer = html_entity_decode($docu->detalles);
          echo $refer;
        ?>
      </div>
      <div class="img">
        <img id="img" src="firma.jpg" style="height:80px;">
        <img id="img" src="Certicol2.png" style="margin-left:250px; height:80px">
      </div>
      <div class="datos">
        <?php
          $refer = html_entity_decode($datos->detalles);
          echo $refer;
        ?>
      </div>
    </div>


  </body>

</html>
