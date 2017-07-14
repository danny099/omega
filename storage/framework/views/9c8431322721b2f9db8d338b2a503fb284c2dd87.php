<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
  <body>
    <center><img id="img" src="Certicol2.png" style="height:100px;"></center><br><br><br>
    <center><h1>Datos del Proyecto</h1></center>
    <table class="table table-bordered">
      <thead>

      </thead>
      <tbody>
        <tr>
          <td>Código del Proyecto</td>
          <td><?php echo e($administrativa->codigo_proyecto); ?></td>
          <td>Valor antes de IVA</td>
          <td>$<?php echo e($administrativa->valor_contrato_inicial); ?></td>
        </tr>
        <tr>
          <td>Nombre del proyecto</td>
          <td><?php echo e($administrativa->nombre_proyecto); ?></td>
          <td>Valor IVA</td>
          <td>$<?php echo e(number_format($administrativa->valor_iva,0)); ?></td>
        </tr>
        <tr>
          <td>Fecha del contrato</td>
          <td><?php echo e(date_format(new DateTime($administrativa->fecha_contrato), 'd-m-y')); ?></td>
          <td>Valor adicional</td>
          <td>
            <?php $__currentLoopData = $adicionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adici): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php echo e($adici->detalle); ?>

              $<?php echo e(number_format($adici->valor,0)); ?>

              <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td>
            <?php if(empty($clientes)): ?>
              <span><?php echo e($juridicas->razon_social); ?></span>
            <?php else: ?>
              <span><?php echo e($clientes->nombre); ?></span>
            <?php endif; ?>
          </td>
          <td>Otro si</td>
          <td>
            <?php $__currentLoopData = $otrosis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              $<?php echo e(number_format($otro->valor,0)); ?>

              <?php echo e($otro->detalles); ?>

              <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </td>

        </tr>
        <tr>
          <td>Municipio</td>
          <td><?php echo e($municipios->nombre); ?></td>
          <td>Valor contrato final</td>
          <td>$<?php echo e(number_format($administrativa->valor_contrato_final,0)); ?></td>

        </tr>
        <tr>
          <td>Departamento</td>
          <td><?php echo e($departamentos->nombre); ?></td>
          <td>Plan de pago</td>
          <td><?php echo e($administrativa->plan_pago); ?></td>

        </tr>
        <tr>
          <td>Tipo zona</td>
          <td><?php echo e($administrativa->tipo_zona); ?></td>
          <td>Valor total</td>
          <td>$<?php echo e(number_format($administrativa->Valor_total_contrato,0)); ?></td>
        </tr>
      </tbody>
    </table>
    <center><h2>Saldo</h2></center>
    <center><span>$<?php echo e(number_format($administrativa->saldo,0)); ?></span></center>

    <br>
    <div class="col-md-12">
     <h4 class="box-title">Observaciones de estado administrativo del proyecto:</h4>
    </div>

    <div class="col-md-12">
      <table border="1" class="table table-bordered" >
        <thead>
          <tr>
            <th>N°</th>
            <th>Observación</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $observaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $obs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?></td>
              <td><?php echo e($obs->observacion); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    <center><h2>Alcances</h2></center>
    <?php if(count($transformaciones) == 0): ?>
    <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Capacidad</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>

        <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <tr>
            <td><?php echo e($transfor->descripcion); ?></td>
            <td><?php echo e($transfor->tipo); ?></td>
            <td><?php echo e($transfor->capacidad); ?></td>
            <td><?php echo e($transfor->unidad); ?></td>
            <td><?php echo e($transfor->cantidad); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php endif; ?>


    <?php if(count($distribuciones) == 0): ?>

    <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($distri->descripcion); ?></td>
            <td><?php echo e($distri->tipo); ?></td>
            <td><?php echo e($distri->unidad); ?></td>
            <td><?php echo e($distri->cantidad); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php endif; ?>

    <?php if(count($pu_finales) == 0): ?>
    <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($pu->descripcion); ?></td>
            <td><?php echo e($pu->tipo); ?></td>
            <td><?php echo e($pu->unidad); ?></td>
            <td><?php echo e($pu->cantidad); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php endif; ?>

    <?php if(count($cuenta_cobros) == 0): ?>
    <?php else: ?>
    <center><h2>Cuenta cobro</h2></center>
      <?php $__currentLoopData = $cuenta_cobros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <table class="table table-bordered">
            <tr>
              <th>Porcentaje</th>
              <td><?php echo e($cuenta->porcentaje); ?></td>
            </tr>
            <tr>
              <th>Valor</th>
              <td>$<?php echo e(number_format($cuenta->valor,0)); ?></td>
            </tr>
            <tr>
              <th>Fecha cuenta cobro</th>
              <td><?php echo e(date_format(new DateTime($cuenta->fecha_cuenta_cobro), 'd-m-y')); ?></td>
            </tr>
            <tr>
              <th>Fecha pago</th>
              <td><?php echo e(date_format(new DateTime($cuenta->fecha_pago), 'd-m-y')); ?></td>
            </tr>
            <tr>
              <th>Número cuenta cobro</th>
              <td><?php echo e($cuenta->numero_cuenta_cobro); ?></td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td><?php echo e($cuenta->observaciones); ?></td>
            </tr>

          </table>
          <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>



    <?php if(count($consignaciones) == 0): ?>
    <?php else: ?>
    <center><h2>Consignaciones</h2></center>
      <?php $__currentLoopData = $consignaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <table class="table table-bordered">
            <tr>
              <th>Fecha Pago</th>
              <td><?php echo e(date_format(new DateTime($consig->fecha_pago), 'd-m-y')); ?></td>
            </tr>
            <tr>
              <th>Valor</th>
              <td>$<?php echo e(number_format($consig->valor,0)); ?></td>
            </tr>
            <tr>
              <th>Valor IVA</th>
              <td>$<?php echo e(number_format($consig->valor_iva,0)); ?></td>
            </tr>
            <tr>
              <th>Valor total</th>
              <td>$<?php echo e(number_format($consig->valor_total,0)); ?></td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td>$<?php echo e($consig->observaciones); ?></td>
            </tr>
          </table>
          <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <br>
    <br>


    <?php if(count($facturas) == 0): ?>

    <?php else: ?>
    <center><h2>Facturas</h2></center>
      <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <table class="table table-bordered">
            <tr>
              <th>Número de la factura</th>
              <td><?php echo e($fac->num_factura); ?></td>
            </tr>
            <tr>
              <th>Fecha de la factura</th>
              <td><?php echo e(date_format(new DateTime($fac->fecha_factura), 'd-m-y')); ?></td>
            </tr>
            <tr>
              <th>Valor antes de IVA</th>
              <td>$<?php echo e(number_format($fac->valor_factura,0)); ?></td>
            </tr>
            <tr>
              <th>IVA</th>
              <td>$<?php echo e(number_format($fac->iva,0)); ?></td>
            </tr>
            <tr>
              <th>Valor total de la factura</th>
              <td>$<?php echo e(number_format($fac->valor_total,0)); ?></td>
            </tr>
            <tr>
              <th>Retenciones %</th>
              <td><?php echo e($fac->rete_porcen); ?> %</td>
            </tr>
            <tr>
              <th>Retenciones valor</th>
              <td>$<?php echo e(number_format($fac->retenciones,0)); ?></td>
            </tr>
            <tr>
              <th>Amortización</th>
              <td>$<?php echo e(number_format($fac->amortizacion,0)); ?></td>
            </tr>
            <tr>
              <th>Pólizas valor</th>
              <td>$<?php echo e(number_format($fac->polizas,0)); ?></td>
            </tr>
            <tr>
              <th>Retegarantía %</th>
              <td><?php echo e($fac->retegaran_porcen); ?> %</td>
            </tr>
            <tr>
              <th>Retegarantía valor</th>
              <td>$<?php echo e(number_format($fac->retegarantia,0)); ?></td>
            </tr>
            <tr>
              <th>Valor pagado</th>
              <td>$<?php echo e(number_format($fac->valor_pagado,0)); ?></td>
            </tr>
            <tr>
              <th>Fecha pago</th>
              <td><?php echo e(date_format(new DateTime($fac->fecha_pago), 'd-m-y')); ?></td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td><?php echo e($fac->observaciones); ?></td>
            </tr>
          </table>
          <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

  </body>
</html>
