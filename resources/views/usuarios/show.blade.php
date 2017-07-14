@extends('index')
<style media="screen">
   .perfil {

      padding:10px 10px 50px 10px;
      margin:10px 10px 50px 10px;
      -webkit-box-shadow: 1px 1px 5px #e3e4e8;
      -moz-box-shadow: 1px 1px 5px #e3e4e8;
      box-shadow: 1px 1px 5px #e3e4e8;
    }
    .espacio{
      -webkit-box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      -moz-box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      box-shadow: 10px 10px 33px 0px rgba(0,0,0,0.75);
      background: white;
    }
    .row{
      padding-right: 400px;
      padding-left:300px;

    }
</style>
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
  <li class="active">Perfiles</li>

</ol>

      <div class="row">
        <div class="col-md-12 espacio">
          <div class="col-md-6">
            <center><img src="{{url('photos')}}/{{$perfil->foto}}" class="perfil" alt="User Image"><center>
          </div>

          <div class="col-md-6">
            <div class="col-md-12">
              <label >Nombres:</label>
              <label>{{$perfil->foto}}</label>
            </div>
            <div class="col-md-12">
              <label >Apellidos:</label>
              <label>{{$perfil->apellidos}}</label>
            </div>
            <div class="col-md-12">
              <label >Email:</label>
              <label>{{$perfil->email}}</label>
            </div>
            <div class="col-md-12">
              <label >rol:</label>
              <label>{{$perfil->roles->rol}}</label>
            </div>

          </div>
        </div>
      </div>
  </div>
</div>
@endsection
