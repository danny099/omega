<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($transformaciones as $transformacion)
      <div class="container">
        <div class="col-md-3 well">
          {{ $transformacion->id}}
          <br>
          {{$transformacion->tipo_transformacion}}
          <br>
          {{$transformacion->tipo_poste}}
          <br>
          {{$transformacion->unidad}}
          <br>
          {{$transformacion->cantidad}}
        </div>
      </div>
    @endforeach
  </body>
</html>
