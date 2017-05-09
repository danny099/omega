@extends('index')

@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Datos del Contrato</li>
</ol>
<div class="container">
  <div class="box box-primary">
    <div class="box-header with-border">
     <center><label>Datos del Proyecto</h3></label>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
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
              <label >Municipio:</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <span>{{ $municipio->nombre }}</span>
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
            <label >Departamento:</label>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <span>{{ $administrativa->departamento->nombre }}</span>
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
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="form-group">
          <label >Cliente:</label>
        </div>
      </div>

    <div class="col-md-3">
      <div class="form-group">

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

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

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

  <div class="col-md-12">
    <div class="col-md-3">
      <div class="form-group">

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label >Valor adicional</label>
    </div>
  </div>
    <span>{{ $administrativa->valor_iva }}</span>
  <div class="col-md-3">
    <div class="form-group">


    </div>
  </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-3">
      <div class="form-group">

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

    </div>
  </div>

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
  </div>

  <div class="col-md-12">
    <div class="col-md-3">
      <div class="form-group">

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

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

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

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

  <div class="col-md-12">
    <div class="col-md-3">
      <div class="form-group">

      </div>
    </div>

  <div class="col-md-3">
    <div class="form-group">

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

  </div>


  <div class="">
    <div class="box-header with-border">
     <center><label>Alcance: proceso de transformacion</h3></label>
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

          <div class="">
            <div class="col-md-12">
              <center><label>Alcance: proceso de distribucion</h4></label>
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

        <div class="">
          <div class="col-md-12">
            <center><label>Alcance: proceso de uso final</h4></label>
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
         <label>Observaciones de estado administrativo del proyecto:</label>
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

    <div class="">
      <h3>Consiganaciones</h3>
    </div>
    @foreach($consignaciones as $consignacion)
      <div class="box box-primary">
        <div class="form-group">
          <label>Fecha de pago:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $consignacion->fecha_pago }}</span>
        </div>
        <div class="form-group">
          <label>Valor:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $consignacion->valor }}</span>
        </div>
        <div class="form-group">
          <label>Observaciones:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $consignacion->observaciones }}</span>
        </div>
      </div>
    @endforeach

    <div class="">
      <h3>Cuanta de Cobro</h3>
    </div>
    @foreach($cuenta_cobros as $cuenta_cobro)
      <div class="box box-primary">
        <div class="form-group">
          <label>Porcentaje:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->porcentaje }}</span>
        </div>
        <div class="form-group">
          <label>Valor:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->valor }}</span>
        </div>
        <div class="form-group">
          <label>Fecha cuenta de cobro:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->fecha_cuenta_cobro }}</span>
        </div>
        <div class="form-group">
          <label>Fecha de pago:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->fecha_pago }}</span>
        </div>
        <div class="form-group">
          <label>Numero cuenta de cobro:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->numero_cuenta_cobro }}</span>
        </div>
        <div class="form-group">
          <label>Observaciones:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $cuenta_cobro->observaciones }}</span>
        </div>
      </div>
    @endforeach

    <div class="">
      <h3>Facturas</h3>
    </div>
    @foreach($facturas as $factura)
      <div class="box box-primary">
        <div class="form-group">
          <label>Numero Factura:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->num_factura }}</span>
        </div>
        <div class="form-group">
          <label>Fecha de factura:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->fecha_factura }}</span>
        </div>
        <div class="form-group">
          <label>Valor Factura:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->valor_factura }}</span>
        </div>
        <div class="form-group">
          <label>IVA:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->iva }}</span>
        </div>
        <div class="form-group">
          <label>Retenciones:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->retenciones }}</span>
        </div>
        <div class="form-group">
          <label>Amortizacion:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->amortizacion }}</span>
        </div>
        <div class="form-group">
          <label>Fecha de pago:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->fecha_pago }}</span>
        </div>
        <div class="form-group">
          <label>Observaciones:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $factura->observaciones }}</span>
        </div>
      </div>
    @endforeach
  </div>

</div>

@endsection

@section('scripts')

@endsection
