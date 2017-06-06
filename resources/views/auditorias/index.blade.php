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
        <div class="row">
          <div class="col-md-12 well">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Archivo</th>
                    <th>Antiguo registro</th>
                    <th>Nuevo registro</th>
                    <th>Fecha y hora</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($auditorias as $auditoria)
                  <tr>
                    <td>{{ $auditoria->user_id }}</td>
                    <td>{{ $auditoria->event }}</td>
                    <td>{{ $auditoria->auditable_id }}</td>
                    <td>{{ $auditoria->old_values }}</td>
                    <td>{{ $auditoria->new_values }}</td>
                    <td>{{date_format(new DateTime($auditoria->created_at ),'d-m-y H:i:s')}}</td>
                  </tr>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
  <script>
    $(function () {
      $('table').dataTable( {
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
  </script>
@endsection
