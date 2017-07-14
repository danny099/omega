<style media="screen">
  .nombre{

	overflow-wrap: break-word;
  }
  .adi{

  overflow-wrap: break-word;
  }
  #factura{
    overflow: auto;
    height: 100%;
  }

  #img{
    width: 50%;
    height: auto;
  }
</style>

<?php $__env->startSection('contenido'); ?>

<ol class="breadcrumb">
  <li><a href="<?php echo e(url('inicio')); ?>">Inicio</a></li>
  <li><a href="<?php echo e(url('administrativas')); ?>">Administrativa</a></li>
  <li class="active">Datos del Contrato</li>
</ol>
  <div class="row">
    <div class="col-md-12">
      <div class="container">
        <div class="box box-primary">
          <div class="">
           <center><h2>Datos del Proyecto</h2></center>
           <a  target="_blank" href="<?php echo e(url('pdf')); ?>/<?php echo e($administrativa->id); ?>">
             <i class="glyphicon glyphicon-print"  title="Imprimir" style=" font-size:40px; color:#33579A ; position:absolute; right:2%; padding:10px;"></i>
           </a>

          </div>


          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                <center><img id="img" src="<?php echo e(url('Certicol2.png')); ?>" ></center><br><br><br>
              </div>
              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label >Código del proyecto:</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <span><?php echo e($administrativa->codigo_proyecto); ?></span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label >Valor antes de IVA:</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">

                    $<?php echo e($administrativa->valor_contrato_inicial); ?>

                  </div>
                </div>

              </div>

              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label >Nombre del proyecto:</label>
                  </div>
                </div>

              <div class="col-md-3 nombre">
                <div class="form-group">
                  <span><?php echo e($administrativa->nombre_proyecto); ?></span>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                    <label >Valor IVA:</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <span>$<?php echo e(number_format($administrativa->valor_iva,0)); ?></span>
              </div>
              </div>


            </div>

            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                  <label >Fecha del contrato:</label>
                </div>
              </div>

            <div class="col-md-3">
              <div class="form-group">
                <span><?php echo e(date_format(new DateTime($administrativa->fecha_contrato), 'd-m-y')); ?></span>
              </div>
            </div>

            <?php if(count($adicionales) == 0): ?>
            <div class="col-md-3 adi">
              <div class="form-group">
                <label >Valor adicional:</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">

                  <span>0</span>

              </div>
            </div>

            <?php else: ?>
            <div class="col-md-3 adi">
              <div class="form-group">
                <label >Valor adicional:</label>
              </div>
            </div>

            <div class="col-md-3 adi">
              <div class="form-group">
                <?php $__currentLoopData = $adicionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adicional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span><?php echo e($adicional->detalle); ?></span>
                  <span>$<?php echo e(number_format($adicional->valor,0)); ?></span>
                  <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
            <?php endif; ?>

          </div>

          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label >Cliente:</label>
              </div>
            </div>

          <div class="col-md-3">
            <div class="form-group">
              <?php if(empty($administrativa->cliente_id)): ?>
              <?php $__currentLoopData = $juridicas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juridica): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span><?php echo e($juridica->razon_social); ?></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <span><?php echo e($administrativa->cliente->nombre); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <?php if(count($otrosis) == 0): ?>
          <div class="col-md-3">
            <div class="form-group">
              <label >Otro sí:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">

              <span> 0</span>

            </div>
          </div>

          <?php else: ?>
          <div class="col-md-3">
            <div class="form-group">
              <label >Otro sí:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group adi">
              <?php $__currentLoopData = $otrosis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otrosi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span><?php echo e($otrosi->detalles); ?></span>
              <span>$<?php echo e(number_format($otrosi->valor_tot,0)); ?></span>
              <?php if($otrosi->recuerdame == 1): ?>
              <a title="Este otro sí esta pendiente">
                <i class="glyphicon glyphicon-alert" style="color: #f39c12"></i>
              </a><br>
              <?php else: ?>
              <br>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <label >Municipio:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span><?php echo e($municipio->nombre); ?></span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Valor contrato final:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              $<?php echo e(number_format($administrativa->valor_contrato_final,0)); ?><br>

            </div>
          </div>


      </div>
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <label >Departamento:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span><?php echo e($administrativa->departamento->nombre); ?></span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Plan de pago:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span><?php echo e($administrativa->formas_pago); ?></span>
            </div>
          </div>


        </div>

        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <label >Tipo de zona:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span><?php echo e($administrativa->tipo_zona); ?></span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Valor Total:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              $<?php echo e(number_format($administrativa->valor_total_contrato,0)); ?><br>

            </div>
          </div>

        </div>

        <div class="col-md-12">
          <div class="col-md-3">

          </div>

          <div class="col-md-3">

          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Saldo:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>$<?php echo e(number_format($administrativa->saldo,0)); ?></span>
            </div>
          </div>

        </div>


        </div>
      </div>

        <div class="col-md-12">
         <h4 class="box-title">Observaciones de estado administrativo del proyecto:</h4>
        </div>

        <div class="col-md-12">
          <table class="table-responsive table-condensed" >
            <thead>
              <tr>
                <th>N°</th>
                <th>Observación</th>
                <th>Fecha de creación</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $observaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $obs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($key+1); ?></td>
                  <td><?php echo e($obs->observacion); ?></td>
                  <td><?php echo e(date_format(new DateTime($obs->created_at), 'd-m-y')); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <br>
        <br>
        <br>
        <br>

          <div class="">

           <center><h3>Alcance del proceso</h3></center>
          </div>

          <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">


                <div class="col-md-12">
                  <div class="col-md-8">
                    <div class="form-group">
                    <center><label >Descripción</label></center>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Unidad</label>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label >Cantidad</label>
                    </div>
                  </div>
                </div>
                <?php if(count($transformaciones) == 0): ?>

                <?php else: ?>
                <div class="">
                  <?php $__currentLoopData = $transformaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transformacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                      <span><?php echo e($transformacion->descripcion); ?></span>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <span><?php echo e($transformacion->tipo); ?></span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span><?php echo e($transformacion->capacidad); ?></span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span><?php echo e($transformacion->unidad); ?></span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span><?php echo e($transformacion->cantidad); ?></span>
                    </div>
                  </div>
                </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php endif; ?>
                <?php if(count($distribuciones) == 0): ?>

                <?php else: ?>
                <div class="">



                <?php $__currentLoopData = $distribuciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distribucion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">

                      <span><?php echo e($distribucion->descripcion); ?></span>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">

                      <span><?php echo e($distribucion->tipo); ?></span>

                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span><?php echo e($distribucion->unidad); ?></span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span><?php echo e($distribucion->cantidad); ?></span>
                    </div>
                  </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <?php endif; ?>
              <?php if(count($pu_finales) == 0): ?>

              <?php else: ?>
              <div class="">


              <?php $__currentLoopData = $pu_finales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pu_final): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-12">
                <div class="col-md-5">
                  <div class="form-group">
                    <span><?php echo e($pu_final->descripcion); ?></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <span><?php echo e($pu_final->tipo); ?></span>

                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <span><?php echo e($pu_final->unidad); ?></span>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <span><?php echo e($pu_final->cantidad); ?></span>
                  </div>
                </div>
              </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


            </div>
              <div class="box-footer">
              </div>
          </div>
        </div>
          <br>
          <br>
          <br>
        <br>

        <?php endif; ?>
        <?php if(count($consignaciones) == 0): ?>

        <?php else: ?>
          <div class="">
            <center><h3>Consignaciones</h3></center>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                <?php $__currentLoopData = $consignaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consignacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 well consig" id='consig'>
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha de pago:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span><?php echo e(date_format(new DateTime($consignacion->fecha_pago), 'd-m-y')); ?></span>
                          </div>
                        </div>
                      </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Valor antes de IVA:</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <span>$<?php echo e(number_format($consignacion->valor,0)); ?></span>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>IVA:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>$<?php echo e(number_format($consignacion->valor_iva,0)); ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Valor:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($consignacion->valor_total,0)); ?></span>
                        </div>
                      </div>
                  </div>
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Observaciones:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span><?php echo e($consignacion->observaciones); ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if(count($cuenta_cobros) == 0): ?>

          <?php else: ?>
          <div class="">
            <center><h3>Cuentas de Cobro</h3></center>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                <?php $__currentLoopData = $cuenta_cobros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuenta_cobro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-4 well cuenta" id='cuenta'>
                    <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Porcentaje:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span><?php echo e($cuenta_cobro->porcentaje); ?>&nbsp;%</span>
                          </div>
                        </div>
                      </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Valor:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($cuenta_cobro->valor,0)); ?></span>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Fecha cuenta de cobro:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <span><?php echo e(date_format(new DateTime($cuenta_cobro->fecha_cuenta_cobro), 'd-m-y')); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Fecha de pago:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <span><?php echo e(date_format(new DateTime($cuenta_cobro->fecha_pago), 'd-m-y')); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Número cuenta de cobro:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <span><?php echo e($cuenta_cobro->numero_cuenta_cobro); ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Observaciones:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <span><?php echo e($cuenta_cobro->observaciones); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>

      <?php endif; ?>
      <?php if(count($facturas) == 0): ?>

      <?php else: ?>
          <div class="">
            <center><h3><a name="facturas" style="color: black;">Facturas</a></h3></center>
          </div>
          <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-4 well factura" id='factura'>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Número Factura:</label>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <span><?php echo e($factura->num_factura); ?></span>
                          <?php if($factura->recuerdame == 1): ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a title="Esta es la factura pendiente">
                            <i class="glyphicon glyphicon-alert" style="color: #ff2f00; font-size:30px; position:absolute"></i>
                          </a>
                          <?php else: ?>

                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Fecha de factura:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span><?php echo e(date_format(new DateTime($factura->fecha_factura), 'd-m-y')); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Valor factura antes de IVA:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->valor_factura,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>IVA:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->iva,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Valor total de la factura:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->valor_total,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Porcentaje retenciones:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span><?php echo e($factura->rete_porcen); ?>&nbsp;%</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Retenciones:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->retenciones,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Amortización:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->amortizacion,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Pólizas:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->polizas,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Porcentaje retegarantía:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span><?php echo e($factura->retegaran_porcen); ?>&nbsp;%</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Retegarantía:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->retegarantia,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Valor pagado:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span>$<?php echo e(number_format($factura->valor_pagado,0)); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Fecha de pago:</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <span><?php echo e(date_format(new DateTime($factura->fecha_pago), 'd-m-y')); ?></span>
                        </div>
                      </div>
                    </div>

                    <?php if($factura->observaciones == null): ?>


                    <?php else: ?>
                    <div class="col-md-12">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Observaciones:</label>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-12 adi">
                      <div class="col-md-12">
                        <div class="form-group">
                          <span><?php echo e($factura->observaciones); ?></span>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>

        </div>
      <?php endif; ?>
      </div>
      </div>
      </div>

    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>