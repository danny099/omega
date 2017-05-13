@extends('index')


@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Datos del Contrato</li>
</ol>

  <div class="row">
    <div class="col-md-12">
      <div class="container">
        <div class="box box-primary">
          <div class="box-header with-border">
           <center><h2>Datos del Proyecto</h2></center>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
            <div class="box-body">

              <div class="col-md-12">
                <center><img src="{{url('Certicol2.png')}}" ></center><br><br><br>
              </div>
              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label >Codigo del proyecto:</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <span>{{ $administrativa->codigo_proyecto }}</span>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label >Valor antes del iva</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <span>{{ $administrativa->valor_contrato_inicial }}</span>
                  </div>
                </div>

              </div>

              <div class="col-md-12">
                <div class="col-md-3">
                  <div class="form-group">
                    <label >nombre del proyecto</label>
                  </div>
                </div>

              <div class="col-md-3">
                <div class="form-group">
                  <span>{{ $administrativa->nombre_proyecto}}</span>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                    <label >Valor iva</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <span>{{ $administrativa->valor_iva }}</span>
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
                <span>{{ $administrativa->fecha_contrato }}</span>
              </div>
            </div>

            @if(count($adicionales) == 0)
            <div class="col-md-3">
              <div class="form-group">
                <label >Valor adicional</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">

                  <span>0</span>

              </div>
            </div>

            @else
            <div class="col-md-3">
              <div class="form-group">
                <label >Valor adicional</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                @foreach($adicionales as $adicional)
                  <span>{{ $adicional->detalle }}</span>
                  <span>${{ $adicional->valor }}</span>
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
              <label >Otro si</label>
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
              <label >Otro si</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              @foreach($otrosis as $otrosi)
              <span> {{ $otrosi->valor }}</span><br>
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
              <label >Valor contrato final</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $administrativa->valor_contrato_final }}</span>
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
              <label >Plan de pago</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $administrativa->plan_pago }}</span>
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
              <label >Saldo</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $administrativa->saldo }}</span>
            </div>
          </div>

        </div>



        </div>


        @if(count($transformaciones) == 0)

        @else
        <div class="">
          <div class="box-header with-border">
           <center><h3 class="box-title">Alcance: proceso de transformacion</h3></center>
          </div>
            <div class="box-body">
                <div class="col-md-12">


                <div class="col-md-12">
                  <div class="col-md-8">
                    <div class="form-group">
                    <center><label >Descripcion</label></center>
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
                  @foreach($transformaciones as $transformacion)
                <div class="col-md-12">
                  <div class="col-md-8">
                    <center><div class="form-group">
                      <span>{{ $transformacion->descripcion }}</span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span>{{ $transformacion->tipo }}</span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span>{{ $transformacion->capacidad }}</span>
                    </div>
                  </div></center>

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
                  <div class="col-md-12">
                    <center><h4 class="box-title">Alcance: proceso de distribucion</h4></center>
                  </div>
                <div class="col-md-12">

                <div class="col-md-12">
                  <div class="col-md-8">
                    <div class="form-group">
                    <center><label >Descripcion</label></center>
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
                @foreach($distribuciones as $distribucion)
                <div class="col-md-12">
                  <div class="col-md-8">
                    <center><div class="form-group">
                      <span>{{ $distribucion->descripcion }}</span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span>{{ $distribucion->tipo }}</span>

                    </div>
                  </div></center>

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
                <div class="col-md-12">
                  <center><h4 class="box-title">Alcance: proceso de uso final</h4></center>
                </div>
              <div class="col-md-12">
                <div class="col-md-8">
                  <div class="form-group">
                  <center><label >Descripcion</label></center>
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
              @foreach($pu_finales as $pu_final)
              <div class="col-md-12">
                <div class="col-md-8">
                  <center><div class="form-group">
                    <span>{{ $pu_final->descripcion }}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $pu_final->tipo }}</span>

                  </div>
                </div></center>

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

              <center><div class="col-md-12">
               <h4 class="box-title">Observaciones de estado administrativo del proyecto:</h4>
              </div>

              <div class="col-md-12">
                <span>{{ $administrativa->resumen }}</span>
              </div></center>
            </div>
              <div class="box-footer">
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
          @foreach($consignaciones as $consignacion)
            <div class="box box-primary">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Fecha de pago:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $consignacion->fecha_pago }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Valor:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $consignacion->valor }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Observaciones:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $consignacion->observaciones }}</span>
                  </div>
                </div>
              </div>


            </div>
          @endforeach

          @endif
          @if(count($cuenta_cobros) == 0)

          @else
          <div class="">
            <center><h3>Cuanta de Cobro</h3></center>
          </div>
          @foreach($cuenta_cobros as $cuenta_cobro)
            <div class="box box-primary">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Porcentaje:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $cuenta_cobro->porcentaje }}%</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Valor:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $cuenta_cobro->valor }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Fecha cuenta de cobro:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $cuenta_cobro->fecha_cuenta_cobro }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Numero cuenta de cobro:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $cuenta_cobro->numero_cuenta_cobro }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Observaciones:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $cuenta_cobro->observaciones }}</span>
                  </div>
                </div>
              </div>

            </div>
          @endforeach

      @endif
      @if(count($facturas) == 0)

      @else
          <div class="">
            <center><h3>Facturas</h3></center>
          </div>
          @foreach($facturas as $factura)
            <div class="box box-primary">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Numero Factura:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->num_factura }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Fecha de factura:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->fecha_factura }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Valor factura antes de iva:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->valor_factura }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>IVA:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->iva }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Valor total de la factura:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->valor_total }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Retenciones:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->retenciones }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Amortizacion:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->amortizacion }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Polizas:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->polizas }}</span>
                  </div>
                </div>
                <div class="col-md-12">

                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Retegarantia:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->retegarantia }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Valor pagado:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->valor_pagado }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Fecha de pago:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->fecha_pago }}</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Observaciones:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{ $factura->observaciones }}</span>
                  </div>
                </div>

              </div>



            </div>
          @endforeach
        </div>
      @endif
      </div>
      </div>
      </div>

    </div>
  </div>

@endsection

@section('scripts')

@endsection
