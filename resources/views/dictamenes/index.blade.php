@extends('index')

@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Dictamenes</li>
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
        <div class="row">
          <div class="col-md-12 well">
            <div class="box-body">
              <a class="btn btn-primary" data-toggle="modal" href="#myModal" style="background-color: #33579A; border-color:#33579A;"><i class="fa fa-user-plus"></i> Crear dictamen</a>
              <!-- inicio modal 5 -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Crear dictamen</h4>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('dictamenes/create') }}" method="get">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-12">

                                <center><label >Código del contrato</label></center>
                                <select class="form-control" name="codigo_con" style="width: 100%;" id="select" required="">
                                  <option value="">Seleccione...</option>
                                  @foreach($contratos as $contrato)
                                  <option value="{{ $contrato->id }}">{{$contrato->codigo_proyecto}} - {{$contrato->nombre_proyecto}}</option>
                                  @endforeach
                                </select>
                                <br>
                                <br>
                                <div class="box-footer">
                                  <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
                                  <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left" style="background-color: #33579A; border-color:#33579A;">Cancelar</button>
                                </div>

                          </div>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
              <!-- fin modal -->
              <br>
              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Codigo proyecto</th>
                    <th>Nombre proyecto</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>

                  @if(empty($dictamenes ))
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  @else
                  @foreach($dictamenes as $dictamen)
                    <tr>
                      <td>{{$dictamen->codigo_proyecto}}</td>
                      <td>{{$dictamen->nombre_proyecto}}</td>
                      <td>
                        <a href="{{ url('dictamenes') }}/{{$dictamen->id}}/edit"><i class="glyphicon glyphicon-pencil"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('pdfDictamen')}}/{{$dictamen->id}}" target="_blank" data-toggle="model" data-target=""><i class="glyphicon glyphicon-eye-open" style="color: #33579A"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('criterio/delete') }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  @endif

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
