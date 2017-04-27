<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($otrosis as $otrosi)
      <div class="container">
        <div class="col-md-3 well">
          {{ $otrosi->id}}
          <br>
          {{$otrosi->valor}}
        </div>
      </div>
    @endforeach
  </body>
</html>
