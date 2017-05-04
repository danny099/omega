@extends('index')

@section('contenido')
      <ol class="breadcrumb">
        <li><a href="{{ url('index') }}">Inicio</a></li>
        <li class="active">Crear Cliente</li>
      </ol>
      <div class="container">
        @if(Session::has('message'))
          <div id="alert">
            <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
            <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{Session::get('message')}}
            </div>
          </div>
        @endif
        <div class="col-md-12 well">
          <div class="box-body">

            <a href="{{ url('usuarios/create') }}" class="btn btn-primary" data-toggle="modal" ><i class="fa fa-user-plus"></i> Crear Usuario</a>
            <br>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
              </thead>

                <tbody>
                  @foreach($usuarios as $usuario)
                <tr>
                  <td>{{ $usuario->cedula }}</td>
                  <td>{{ $usuario->nombres }}</td>
                  <td>{{ $usuario->apellidos }}</td>
                  <td>{{ $usuario->email }}</td>
                  <td>{{ $usuario->roles->rol }}</td>
                  <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('deleteusuarios') }}/{{ $usuario->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                  </td>


                </tr>

                  @endforeach
                </tbody>

              <tfoot>

              </tfoot>
            </table>
          </div>
        </div>
        </div>



@endsection

@section('scripts')

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

@endsection
