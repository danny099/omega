@extends('index')

@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Datos del Contrato</li>
</ol>
<div class="box box-primary">
  <div class="box-header with-border">
   <h3 class="box-title">Datos del Contrato</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">
      <div class="col-md-4">
        <div class="form-group">
          <label >Codigo del proyecto:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->codigo_proyecto }}</span>
        </div>
        <div class="form-group">
          <label >nombre del proyecto</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->nombre_proyecto}}</span>
        </div>
        <div class="form-group">
          <label >Fecha del contrato:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->fecha_contrato }}</span>
        </div>
        <div class="form-group">
          <label >Cliente:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->cliente->nombre }}</span>
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Departamento:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->departamento->nombre }}</span>
        </div>
        <div class="form-group">
          <label >Municipios:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $municipio->nombre }}</span>
        </div>
        <div class="form-group">
          <label >Tipo de zona:</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->tipo_zona }}</span>
        </div>
        <div class="form-group">
          <label >Valor antes del iva</label>
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Valor iva</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $administrativa->valor_iva }}</span>
        </div>

        <div class="form-group ">
          <div class="col-md-11" >
            <label >Valor adicional</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $administrativa->valor_iva }}</span>
          </div>
        <label >Otro si</label>
        <div class="form-group ">
          <div class="col-md-11" >
          </div>
          @foreach($otrosis as $otrosi)
          <span> {{ $otrosi->valor }}</span><br>
          @endforeach
          <div class="form-group">
            <br>
            <br>
            <label >Valor contrato final</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $administrativa->valor_contrato_final }}</span>
          </div>

          <div class="form-group">
            <label >Plan de pago</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $administrativa->plan_pago }}</span>
          </div>
        </div>
      </div>
      <hr>

</div>
</div>


<div class="">
  <div class="box-header with-border">
   <center><h3 class="box-title">Alcance: proceso de transformacion</h3></center>
  </div>
    <div class="box-body">
        <div class="col-md-12">
          @foreach($transformaciones as $transformacion)
          <div class="col-md-3">
            <div class="form-group">
            <label >Descripcion</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $transformacion->descripcion }}</span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
            <label >Tipo</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $transformacion->tipo }}</span>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
            <label >Capacidad</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $transformacion->capacidad }}</span>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
            <label>Unidad</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $transformacion->unidad }}</span>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
            <label >Cantidad</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>{{ $transformacion->cantidad }}</span>
            </div>
          </div>
          @endforeach
        </div>
<br>
<br>
<br>
<br>
      <div class="">
        <div class="col-md-12">
          <center><h4 class="box-title">Alcance: proceso de distribucion</h4></center>
        </div>
        @foreach($distribuciones as $distribucion)
        <div class="col-md-3">
          <div class="form-group">
          <label >Descripcion</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $distribucion->descripcion }}</span>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <label >Tipo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $distribucion->tipo }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
          <label >Unidad</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $distribucion->unidad }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
          <label >Cantidad</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $distribucion->cantidad }}</span>
          </div>
        </div>
        @endforeach
      </div>
      <br>
      <br>
      <br>
      <br>
      <div class="">
        <div class="col-md-12">
          <center><h4 class="box-title">Alcance: proceso de uso final</h4></center>
        </div>
        @foreach($pu_finales as $pu_final)
        <div class="col-md-3">
          <div class="form-group">
          <label >Descripcion</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $pu_final->descripcion }}</span>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
          <label >Tipo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $pu_final->tipo }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
          <label >Unidad</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $pu_final->unidad }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
          <label >Cantidad</label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span>{{ $pu_final->cantidad }}</span>
          </div>
        </div>
        @endforeach
      </div>


      <div class="col-md-12">
       <h4 class="box-title">Observaciones de estado administrativo del proyecto:</h4>
      </div>

      <div class="col-md-12">
        <span>{{ $administrativa->resumen }}</span>
      </div>
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


@endsection

@section('scripts')

@endsection
