<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($pu_finales as $pu_final)
      <div class="container">
        <div class="col-md-3 well">
          {{ $pu_final->id}}
          <br>
          {{$pu_final->tipo_retie}}
          <br>
          {{$pu_final->tipo_residencial}}
          <br>
          {{$pu_final->unidad}}
          <br>
          {{$pu_final->cantidad}}
        </div>
      </div>
    @endforeach
  </body>
</html>
