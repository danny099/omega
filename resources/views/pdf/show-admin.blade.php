<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/css/bootstrap.css">
  </head>
  <style media="screen">
      table {
        width: 100%;
      }
      th, td {
        width: 25%;
        text-align: left;
      }
  </style>
  <body>
    <center><h1>Datos del Proyecto</h1></center>
    <table border="1">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Código del Proyecto</td>
          <td>{{ $administrativa->codigo_proyecto}}</td>
          <td>Valor antes de IVA</td>
          <td>${{  $administrativa->valor_contrato_inicial }}</td>
        </tr>
        <tr>
          <td>Nombre del proyecto</td>
          <td>{{ $administrativa->nombre_proyecto}}</td>
          <td>Valor IVA</td>
          <td>${{  number_format($administrativa->valor_iva,0) }}</td>
        </tr>
        <tr>
          <td>Fecha del contrato</td>
          <td>{{ $administrativa->fecha_contrato}}</td>
          <td>valor Adicional</td>
          <td>
            @foreach($adicionales as $adici)
              ${{ number_format($adici->valor,0) }}
              {{ $adici->detalle }}
              <br>
            @endforeach
          </td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td>
            @if(empty($clientes))
              <span>{{ $juridicas->razon_social }}</span>
            @else
              <span>{{ $clientes->nombre}}</span>
            @endif
          </td>
          <td>Otro si</td>
          <td>
            @foreach($otrosis as $otro)
              ${{ number_format($otro->valor,0) }}
              {{ $otro->detalles }}
              <br>
            @endforeach
          </td>

        </tr>
        <tr>
          <td>Municipio</td>
          <td>{{ $municipios->nombre }}</td>
          <td>Valor contrato final</td>
          <td>${{ number_format($administrativa->valor_contrato_final,0)}}</td>

        </tr>
        <tr>
          <td>Departamento</td>
          <td>{{ $departamentos->nombre }}</td>
          <td>Plan de pago</td>
          <td>{{ $administrativa->plan_pago}}</td>

        </tr>
        <tr>
          <td>Tipo zona</td>
          <td>{{ $administrativa->tipo_zona }}</td>
          <td>Valor total</td>
          <td>${{ number_format($administrativa->Valor_total_contrato,0)}}</td>
        </tr>
      </tbody>
    </table>
    <center><h2>Saldo</h2></center>
    <center><span>${{ number_format($administrativa->saldo,0) }}</span></center>

    <br>
    <div class="col-md-12">
     <h4 class="box-title">Observaciones de estado administrativo del proyecto:</h4>
    </div>

    <div class="col-md-12">
      <table border="1" class="table-responsive table-condensed" >
        <thead>
          <tr>
            <th>N°</th>
            <th>Observación</th>
          </tr>
        </thead>
        <tbody>
          @foreach($observaciones as $key => $obs)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $obs->observacion }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    <center><h2>Alcances</h2></center>
    @if(empty($transformaciones))
    @else
    <table border="1">
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
        @foreach($transformaciones as $transfor)
          <tr>
            <td>{{ $transfor->descripcion }}</td>
            <td>{{ $transfor->tipo }}</td>
            <td>{{ $transfor->capacidad }}</td>
            <td>{{ $transfor->unidad }}</td>
            <td>{{ $transfor->cantidad }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    <br>
    <br>
    @if(empty($distribuciones))

    @else
    <table border="1">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach($distribuciones as $distri)
          <tr>
            <td>{{ $distri->descripcion }}</td>
            <td>{{ $distri->tipo }}</td>
            <td>{{ $distri->unidad }}</td>
            <td>{{ $distri->cantidad }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    <br>
    <br>
    @if(empty($pu_finales))
    @else
    <table border="1">
      <thead>
        <tr>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pu_finales as $pu)
          <tr>
            <td>{{ $pu->descripcion }}</td>
            <td>{{ $pu->tipo }}</td>
            <td>{{ $pu->unidad }}</td>
            <td>{{ $pu->cantidad }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif
    <br>
    <br>

    @if(empty($cuenta_cobros))
    @else
    <center><h2>Cuenta cobro</h2></center>
      @foreach($cuenta_cobros as $cuenta)
          <table border="1">
            <tr>
              <th>Porcentaje</th>
              <td>{{ $cuenta->porcentaje }}</td>
            </tr>
            <tr>
              <th>Valor</th>
              <td>${{ number_format($cuenta->valor,0) }}</td>
            </tr>
            <tr>
              <th>Fecha cuenta cobro</th>
              <td>{{ $cuenta->fecha_cuenta_cobro }}</td>
            </tr>
            <tr>
              <th>Fecha pago</th>
              <td>{{ $cuenta->fecha_pago }}</td>
            </tr>
            <tr>
              <th>Numero cuenta cobro</th>
              <td>{{ $cuenta->numero_cuenta_cobro }}</td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td>{{ $cuenta->observaciones }}</td>
            </tr>

          </table>
          <br>
        @endforeach
    @endif
    <br>
    <br>


    @if(empty($consignaciones))
    @else
    <center><h2>Consignaciones</h2></center>
      @foreach($consignaciones as $consig)
          <table border="1">
            <tr>
              <th>Fecha Pago</th>
              <td>{{ $consig->fecha_pago }}</td>
            </tr>
            <tr>
              <th>Valor</th>
              <td>${{ number_format($consig->valor,0) }}</td>
            </tr>
            <tr>
              <th>Valor IVA</th>
              <td>${{ number_format($consig->valor_iva,0)}}</td>
            </tr>
            <tr>
              <th>Valor total</th>
              <td>${{ number_format($consig->valor_total,0)}}</td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td>${{ $consig->observaciones }}</td>
            </tr>
          </table>
          <br>
        @endforeach
    @endif

    <br>
    <br>


    @if(empty($facturas))
    @else
    <center><h2>Facturas</h2></center>
      @foreach($facturas as $fac)
          <table border="1">
            <tr>
              <th>Numeró de la factura</th>
              <td>{{ $fac->num_factura }}</td>
            </tr>
            <tr>
              <th>Fecha de la factura</th>
              <td>{{ $fac->fecha_factura }}</td>
            </tr>
            <tr>
              <th>Valor antes de IVA</th>
              <td>${{ number_format($fac->valor_factura,0)}}</td>
            </tr>
            <tr>
              <th>IVA</th>
              <td>${{ number_format($fac->iva,0)}}</td>
            </tr>
            <tr>
              <th>Valor total de la factura</th>
              <td>${{ number_format($fac->valor_total,0)}}</td>
            </tr>
            <tr>
              <th>Renciones %</th>
              <td>{{ $fac->rete_porcen }}</td>
            </tr>
            <tr>
              <th>Retenciones valor</th>
              <td>${{ number_format($fac->retenciones,0)}}</td>
            </tr>
            <tr>
              <th>Amortización</th>
              <td>${{ number_format($fac->amortizacion,0)}}</td>
            </tr>
            <tr>
              <th>Pólizas valor</th>
              <td>${{ number_format($fac->polizas,0)}}</td>
            </tr>
            <tr>
              <th>Retegarantía %</th>
              <td>${{ $fac->retegaran_porcen }}</td>
            </tr>
            <tr>
              <th>Retegarantía valor</th>
              <td>${{ number_format($fac->retegarantia,0)}}</td>
            </tr>
            <tr>
              <th>Valor pagado</th>
              <td>${{ number_format($fac->valor_pagado,0)}}</td>
            </tr>
            <tr>
              <th>Fecha pago</th>
              <td>{{ $fac->fecha_pago }}</td>
            </tr>
            <tr>
              <th>Observaciones</th>
              <td>{{ $fac->observaciones }}</td>
            </tr>
          </table>
          <br>
        @endforeach
    @endif

  </body>
</html>
