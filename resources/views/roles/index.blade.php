<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($roles as $rol)
      <div class="container">
        <div class="col-md-3 well">
          {{ $rol->id}}
          <br>
          {{$rol->rol}}
        </div>
      </div>
    @endforeach
  </body>
</html>
