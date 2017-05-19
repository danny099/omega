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
    <center><h1>Datos del Pryecto</h1></center>
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
          <td>Codigo del Proyecto</td>
          <td>{{ $administrativa->codigo_proyecto}}</td>
          <td>Valor antes de iva</td>
          <td>{{ $administrativa->valor_contrato_inicial }}</td>
        </tr>
        <tr>
          <td>Nombre del proyecto</td>
          <td>{{ $administrativa->nombre_proyecto}}</td>
          <td>Valor iva</td>
          <td>{{ $administrativa->valor_iva }}</td>
        </tr>
        <tr>
          <td>Fecha del contrato</td>
          <td>{{ $administrativa->fecha_contrato}}</td>
          <td>valor Adicional</td>
          <td>
            @foreach($adicionales as $adici)
              {{ $adici->valor }}
              {{ $adici->detalle }}
              <br>
            @endforeach
          </td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td>
            @if(empty($clientes))
              <!-- <span>{{ $juridicas->razon_social }}</span> -->
            @else
              <span>{{ $clientes->nombre}}</span>
            @endif
          </td>
          <td>Otro si</td>
          <td>
            @foreach($otrosis as $otro)
              {{ $otro->valor }}
              {{ $otro->detalles }}
              <br>
            @endforeach
          </td>

        </tr>
        <tr>
          <td>Municipio</td>
          <td>{{ $municipios->nombre }}</td>
          <td>Valor contrato final</td>
          <td>{{ $administrativa->valor_contrato_final}}</td>

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
          <td>{{ $administrativa->Valor_total_contrato}}</td>
        </tr>
      </tbody>
    </table>
    <center><h2>Saldo</h2></center>
    <center><span>{{ $administrativa->saldo }}</span></center>

    <br>
    <br>
    <center><h2>Alcances</h2></center>
    <table border="1">
      <thead>
        <tr>
          <th>Descripcion</th>
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
    <br>
    <br>
    <table border="1">
      <thead>
        <tr>
          <th>Descripcion</th>
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
    <br>
    <br>
    <table border="1">
      <thead>
        <tr>
          <th>Descripcion</th>
          <th>Tipo</th>
          <th>Unidad</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pu_finales as $pu)
          <tr>
            <td>{{ $distri->descripcion }}</td>
            <td>{{ $distri->tipo }}</td>
            <td>{{ $distri->unidad }}</td>
            <td>{{ $distri->cantidad }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
