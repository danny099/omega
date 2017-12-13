<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css" media="screen">
      body{
        margin: 5px;
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12px;
      }

      table {
          border-collapse: collapse;
      }

      table, td, th {
          border: 1px solid black;
          font-weight: normal;
      }

    </style>
  </head>
  <body>
    <table border="1">
      @foreach($descripciones as $key =>$descripcion)
      <tr>
        <th>{{$descripcion->descripcion}}</th>
        <th>{{$descripcion->fecha}}</th>

        @inject('nc','App\Http\Controllers\PdfController')
        @foreach($nc->ncs($descripcion->id) as $key2 => $registro)

          @foreach($registro as $reg)

            <th>{{$reg->nc}}</th>

          @endforeach
        @endforeach
      </tr>
      @endforeach
    </table>
  </body>
</html>
