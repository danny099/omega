@extends('index')

@section('contenido')

  <div class="error-page">
    <h2 class="headline text-red">500</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-red"></i> ¡Vaya! Algo salió mal.</h3>

      <p>Vamos a trabajar en el error de inmediato.
         Mientras tanto, usted puede <a href="javascript:history.go(-1)">regresar</a> o intente consultar a su administrador.
      </p>

      <!-- <form class="search-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search">

          <div class="input-group-btn">
            <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->
    </div>
  </div>

@endsection
