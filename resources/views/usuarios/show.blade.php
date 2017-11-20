@extends('index')
<style media="screen">
   .perfil {

      padding:10px 10px 50px 10px;
      margin:10px 10px 50px 10px;
      -webkit-box-shadow: 1px 1px 5px #e3e4e8;
      -moz-box-shadow: 1px 1px 5px #e3e4e8;
      box-shadow: 1px 1px 5px #e3e4e8;
      width: 200px;
      height: 300px;
    }
    .espacio{
      -webkit-box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      -moz-box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      background: white;
      padding: 20px;
      width: 100%;
    }

    @media screen and (min-width: 1580px) {
      .row{
        padding-right: 400px;
        padding-left:300px;
        width: 100%;
      }
    }


    label{
      font-size: 24px;
    }
    p{
      font-size: 24px;
    }
</style>
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
  <li class="active">Perfiles</li>

</ol>

      <div class="row ">
        <div class="col-md-12 espacio">
          <div class="col-md-5">
            <center><img src="{{url('photos')}}/{{$perfil->foto}}" class="perfil img-responsive" alt="User Image"><center>
          </div>

          <div class="col-md-7" style="padding-top:70px;">
            <div class="col-md-12">
              <div class="col-md-6">
                <label >Nombres:</label>
              </div>
              <div class="col-md-6">
                <p>{{$perfil->nombres}}</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-6">
                <label >Apellidos:</label>
              </div>
              <div class="col-md-6">
                <p>{{$perfil->apellidos}}</p>
              </div>

            </div>
            <div class="col-md-12">
              <div class="col-md-6">
                <label >Email:</label>
              </div>
              <div class="col-md-6">
                <p>{{$perfil->email}}</p>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-6">
                <label >Rol:</label>
              </div>
              <div class="col-md-6">
                <p>{{$perfil->roles->rol}}</p>
              </div>
            </div>

          </div>
          <br>
          <br>
          <br>
          <a href="{{ url('editarPerfil') }}" class="btn btn-primary pull-right" data-toggle="modal" ><i class="fa fa-user-plus"></i> Editar Perfil</a>
        </div>
      </div>
  </div>
</div>
@endsection
