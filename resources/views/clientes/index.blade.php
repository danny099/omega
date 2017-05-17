@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
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
        <a href="#modal" class="btn btn-primary" data-toggle="modal" ><i class="fa fa-user-plus"></i> Crear Cliente</a>
        <br>
        <br>
        <div class="box box-primary">
          <div class="box-header with-border">
            <center> <h3 class="box-title">Personas naturales</h3> </center>
          </div>
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
                <th>Aciones</th>
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
                <td>
                  <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('deleteclientes') }}/{{ $cliente->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <center> <h3 class="box-title">Personas juridicas</h3> </center>
          </div>
          <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Razon social</th>
                <th>Nit</th>
                <th>Nombre representante</th>
                <th>Cedula</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Aciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($juridicas as $juridica)
              <tr>
                <td>{{ $juridica->razon_social }}</td>
                <td>{{ $juridica->nit }}</td>
                <td>{{ $juridica->nombre_representante }}</td>
                <td>{{ $juridica->cedula }}</td>
                <td>{{ $juridica->direccion }}</td>
                <td>{{ $juridica->telefono }}</td>
                <td>{{ $juridica->email }}</td>
                <td>
                  <a href="{{ route('juridica.edit', $juridica->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('deletejuridica') }}/{{ $juridica->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
        <!-- modal 1 -->
        <div class="modal fade" id="modal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Clientes</h4>
              </div>
              <div class="modal-body">
                <center><h4> ¿Desea crear un cliente? </h4></center>
                <br>
                <center>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2" name="button">Persona natural</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3" name="button">Persona juridica</button>
                </center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
          <!-- fin modal -->
          <!-- modal 2 -->
        <div class="modal fade" id="modal2"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
              @include('clientes.create')
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
        <!-- fin modal2 -->
        <!-- modal 3 -->
        <div class="modal fade" id="modal3"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('juridica.create')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
      <!-- fin modal3 -->
      </div>
    </div>
  </div>



@endsection

@section('scripts')
<script>
  $(function () {
    $("table").DataTable({
      "language":{
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }
 });
  });
</script>
@endsection
