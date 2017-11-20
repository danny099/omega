@extends('index')

@section('contenido')

    <!-- Content Header (Page header) -->
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> ¡Vaya! Página no encontrada.</h3>

          <p>
            No hemos podido encontrar la página que buscabas.
            Mientras tanto, usted puede <a href="javascript:history.go(-1)">regresar</a> o intente consultar a su administrador.
          </p>

          <!-- <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>

          </form> -->
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->

@endsection()
