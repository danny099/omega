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
    <table>
      <thead>
        <tr>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Codigo del Proyecto</td>
          <td>{{ $administrativa->codigo_proyecto}}</td>
        </tr>
        <tr>
          <td>Nombre del proyecto</td>
          <td>{{ $administrativa->nombre_proyecto}}</td>
        </tr>
        <tr>
          <td>Fecha del contrato</td>
          <td>{{ $administrativa->fecha_contrato}}</td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td>
            @if(empty($administrativa->cliente_id))
            @foreach($juridicas as $juridica)
              <span>{{ $juridica->razon_social }}</span>
            @endforeach
            @else
            <span>{{ $administrativa->cliente->nombre }}</span>
            @endif
          </td>
        </tr>
        <tr>
          <td>Municipio</td>
          <!-- <td>{{ $juridicas->nombre}}</td> -->
        </tr>
        <tr>
          <td>Departamento</td>
          <td>{{ $departamentos->nombre }}</td>
        </tr>
        <tr>
          <td>Tipo zona</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
