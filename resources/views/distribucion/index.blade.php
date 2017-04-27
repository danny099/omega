<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($distribuciones as $distribucion)
      <div class="container">
        <div class="col-md-3 well">
          {{ $distribucion->id}}
          <br>
          {{$distribucion->tipo_distribucion}}
          <br>
          {{$distribucion->tipo_red}}
          <br>
          {{$distribucion->unidad}}
          <br>
          {{$distribucion->cantidad}}
        </div>
      </div>
    @endforeach
  </body>
</html>
