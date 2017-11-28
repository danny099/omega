@extends('index')
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

@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Datos del Contrato</li>
</ol>
  <div class="row">
    <div class="col-md-12">
      <div class="container">
        <div class="box box-primary">
          <div class="">
           <center><h2>Datos del Proyecto</h2></center>
           <a class="btn btn-primary" href="<?php echo '/omega/trunk/public//documento'.'/'.$administrativa->codigo_proyecto .'-'. $administrativa->nombre_proyecto.'.docx'; ?>" style="background-color: #33579A; border-color:#33579A;position: relative; left: 950; top: -40;" >Descargar contrato</a>

          </div>


          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                <center><img id="img" src="{{url('Certicol2.png')}}" ></center><br><br><br>
              </div>
              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label >Código del proyecto:</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <span>{{ $administrativa->codigo_proyecto }}</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label >Valor antes de IVA:</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">

                    ${{$administrativa->valor_contrato_inicial}}
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
                  <span>{{ $administrativa->nombre_proyecto}}</span>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                    <label >Valor IVA:</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <span>${{ number_format($administrativa->valor_iva,0) }}</span>
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
                <span>{{ date_format(new DateTime($administrativa->fecha_contrato), 'd-m-y') }}</span>
              </div>
            </div>

            @if(count($adicionales) == 0)
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

            @else
            <div class="col-md-3 adi">
              <div class="form-group">
                <label >Valor adicional:</label>
              </div>
            </div>

            <div class="col-md-3 adi">
              <div class="form-group">
                @foreach($adicionales as $adicional)
                  <span>{{ $adicional->detalle }}</span>
                  <span>${{ number_format($adicional->valor,0) }}</span>
                  <br>
                @endforeach
              </div>
            </div>
            @endif

          </div>

          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label >Cliente:</label>
              </div>
            </div>

          <div class="col-md-3">
            <div class="form-group">
              @if(empty($administrativa->cliente_id))
              @foreach($juridicas as $juridica)
                <span>{{ $juridica->razon_social }}</span>
              @endforeach
              @else
              <span>{{ $administrativa->cliente->nombre }}</span>
              @endif
            </div>
          </div>

          @if(count($otrosis) == 0)
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

          @else
          <div class="col-md-3">
            <div class="form-group">
              <label >Otro sí:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group adi">
              @foreach($otrosis as $otrosi)
              <span>{{ $otrosi->detalles }}</span>
              <span>${{ number_format($otrosi->valor_tot,0) }}</span>
              @if($otrosi->recuerdame == 1)
              <a title="Este otro sí esta pendiente">
                <i class="glyphicon glyphicon-alert" style="color: #f39c12"></i>
              </a><br>
              @else
              <br>
              @endif
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <label >Municipio:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $municipio->nombre }}</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Valor contrato final:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              ${{ number_format($administrativa->valor_contrato_final,0) }}<br>

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
              <span>{{ $administrativa->departamento->nombre }}</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Plan de pago:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $administrativa->formas_pago }}</span>
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
              <span>{{ $administrativa->tipo_zona }}</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label >Valor Total:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              ${{ number_format($administrativa->valor_total_contrato,0) }}<br>

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
              <span>${{ number_format($administrativa->saldo,0) }}</span>
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
              @foreach($observaciones as $key => $obs)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $obs->observacion }}</td>
                  <td>{{ date_format(new DateTime($obs->created_at), 'd-m-y') }}</td>
                </tr>
              @endforeach
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
                @if(count($transformaciones) == 0)

                @else
                <div class="">
                  @foreach($transformaciones as $transformacion)
                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">
                      <span>{{ $transformacion->descripcion }}</span>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <span>{{ $transformacion->tipo }}</span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span>{{ $transformacion->capacidad }}</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span>{{ $transformacion->unidad }}</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span>{{ $transformacion->cantidad }}</span>
                    </div>
                  </div>
                </div>
                  @endforeach
                </div>

                @endif
                @if(count($distribuciones) == 0)

                @else
                <div class="">



                @foreach($distribuciones as $distribucion)
                <div class="col-md-12">
                  <div class="col-md-5">
                    <div class="form-group">

                      <span>{{ $distribucion->descripcion }}</span>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">

                      <span>{{ $distribucion->tipo }}</span>

                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span>{{ $distribucion->unidad }}</span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <span>{{ $distribucion->cantidad }}</span>
                    </div>
                  </div>
                </div>

                @endforeach
              </div>

              @endif
              @if(count($pu_finales) == 0)

              @else
              <div class="">


              @foreach($pu_finales as $pu_final)
              <div class="col-md-12">
                <div class="col-md-5">
                  <div class="form-group">
                    <span>{{ $pu_final->descripcion }}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <span>{{ $pu_final->tipo }}</span>

                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <span>{{ $pu_final->unidad }}</span>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <span>{{ $pu_final->cantidad }}</span>
                  </div>
                </div>
              </div>

              @endforeach
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

        @endif
        @if(count($consignaciones) == 0)

        @else
          <div class="">
            <center><h3>Consignaciones</h3></center>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                @foreach($consignaciones as $consignacion)
                <div class="col-md-4 well consig" id='consig'>
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha de pago:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>{{ date_format(new DateTime($consignacion->fecha_pago), 'd-m-y') }}</span>
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
                              <span>${{ number_format($consignacion->valor,0) }}</span>
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
                            <span>${{ number_format($consignacion->valor_iva,0) }}</span>
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
                          <span>${{ number_format($consignacion->valor_total,0) }}</span>
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
                            <span>{{ $consignacion->observaciones }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
                </div>
              </div>
            </div>
          @endif
          @if(count($cuenta_cobros) == 0)

          @else
          <div class="">
            <center><h3>Cuentas de Cobro</h3></center>
          </div>
          <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-12">
                @foreach($cuenta_cobros as $cuenta_cobro)
                  <div class="col-md-4 well cuenta" id='cuenta'>
                    <div class="col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Porcentaje:</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <span>{{ $cuenta_cobro->porcentaje }}&nbsp;%</span>
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
                          <span>${{ number_format($cuenta_cobro->valor,0) }}</span>
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
                        <span>{{ date_format(new DateTime($cuenta_cobro->fecha_cuenta_cobro), 'd-m-y') }}</span>
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
                        <span>{{ date_format(new DateTime($cuenta_cobro->fecha_pago), 'd-m-y') }}</span>
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
                        <span>{{ $cuenta_cobro->numero_cuenta_cobro }}</span>
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
                        <span>{{ $cuenta_cobro->observaciones }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>

      @endif
      @if(count($facturas) == 0)

      @else
          <div class="">
            <center><h3><a name="facturas" style="color: black;">Facturas</a></h3></center>
          </div>
          <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              @foreach($facturas as $factura)
                  <div class="col-md-4 well factura" id='factura'>
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Número Factura:</label>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <span>{{ $factura->num_factura }}</span>
                          @if($factura->recuerdame == 1)
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a title="Esta es la factura pendiente">
                            <i class="glyphicon glyphicon-alert" style="color: #ff2f00; font-size:30px; position:absolute"></i>
                          </a>
                          @else

                          @endif
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
                          <span>{{ date_format(new DateTime($factura->fecha_factura), 'd-m-y') }}</span>
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
                          <span>${{ number_format($factura->valor_factura,0) }}</span>
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
                          <span>${{ number_format($factura->iva,0) }}</span>
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
                          <span>${{ number_format($factura->valor_total,0) }}</span>
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
                          <span>{{ $factura->rete_porcen }}&nbsp;%</span>
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
                          <span>${{ number_format($factura->retenciones,0) }}</span>
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
                          <span>${{ number_format($factura->amortizacion,0) }}</span>
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
                          <span>${{ number_format($factura->polizas,0) }}</span>
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
                          <span>{{ $factura->retegaran_porcen }}&nbsp;%</span>
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
                          <span>${{ number_format($factura->retegarantia,0) }}</span>
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
                          <span>${{ number_format($factura->valor_pagado,0) }}</span>
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
                          <span>{{ date_format(new DateTime($factura->fecha_pago), 'd-m-y') }}</span>
                        </div>
                      </div>
                    </div>

                    @if($factura->observaciones == null)


                    @else
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
                          <span>{{ $factura->observaciones }}</span>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>

              @endforeach
            </div>
          </div>
        </div>

        </div>
      @endif
      </div>
      </div>
      </div>

    </div>
  </div>

@endsection
