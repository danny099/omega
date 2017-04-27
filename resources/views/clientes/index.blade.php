@extends('index')

@section('contenido')

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

            <a href="{{ url('clientes/create') }}" class="btn btn-primary" data-toggle="modal" ><i class="fa fa-user-plus"></i> Crear Cliente</a>
            <br>
            <br>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nit</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Email</th>
              </tr>
              </thead>

                <tbody>
                  @foreach($clientes as $cliente)
                <tr>
                  <td>{{ $cliente->nit }}</td>
                  <td>{{ $cliente->cedula }}</td>
                  <td>{{ $cliente->nombre }}</td>
                  <td>{{ $cliente->contacto }}</td>
                  <td>{{ $cliente->telefono }}</td>
                  <td>{{ $cliente->direccion }}</td>
                  <td>{{ $cliente->email }}</td>
                  <td><a href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                  <td><a href="{{ url('deleteclientes') }}/{{ $cliente->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a></td>

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
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

@endsection
