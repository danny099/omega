@extends('index')
@section('scripts')
<script>
  $(function () {
    $('table.display').dataTable( {
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
  },
        "scrollX": true

} );
  });
  //evento encargado de poner municipios de un departamento elegido
  $(document).ready(function(){
  $(document).on('change','#departamento',function(){

  var dep_id = $(this).val();
  var div = $(this).parents();
  var op=" ";
  $.ajax({
  type:'get',
  url:'{{ url('selectmuni')}}',
  data:{'id':dep_id},
  success:function(data){
  console.log(data);
  op+='<option value="0" selected disabled>Seleccione</option>';

  for (var i = 0; i < data.length; i++) {
  op+='<option value="' +data[i].id+ '">' +data[i].nombre+ '</option>'
  }

  div.find('#municipio').html(" ");
  div.find('#municipio').append(op);

  },
  error:function(){

  }
  });
  });
  });

</script>
@endsection
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Clientes</li>
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
        <a href="#modal" class="btn btn-primary" data-toggle="modal" style="background-color: #33579A; border-color:#33579A;"><i class="fa fa-user-plus"></i> Crear Cliente</a>
        <br>
        <br>
        <div class="box box-primary">
          <div class="box-header with-border">
            <center> <h3 >Personas naturales</h3> </center>
          </div>
          <table id="example1" class="table table-bordered table-striped display">
            <thead>
              <tr>
                <th>Nit</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Télefono</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>
              @foreach($clientes as $cliente)
              <tr>
                <td>{{ $cliente->nit }}</td>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                  <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('deleteclientes') }}/{{ $cliente->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
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
            <center> <h3 >Personas jurídicas</h3> </center>
          </div>
          <table id="example2" class="table table-bordered table-striped display">
            <thead>
              <tr>
                <th>Razón social</th>
                <th>Nit</th>
                <th>Nombre representante</th>
                <th>Cédula</th>
                <th>Dirección</th>
                <th>Télefono</th>
                <th>Email</th>
                <th>Acciones</th>
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
                  <a href="{{ route('juridica.edit', $juridica->id) }}"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('deletejuridica') }}/{{ $juridica->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2" name="button" style="background-color: #33579A; border-color:#33579A;">Persona natural</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3" name="button" style="background-color: #33579A; border-color:#33579A;">Persona jurídica</button>
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
