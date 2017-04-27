@extends('index')

@section('contenido')

      <div class="container">
        <div class="col-md-12 well">
          <a class="btn btn-primary" data-toggle="modal" href="{{ url('administrativas/create') }}"><i class="fa fa-user-plus"></i> Crear Contrato</a>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Codigo del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Fecha del contrato</th>
                <th>Cliente</th>
                <th>Valor final del contrato</th>
                <th>Acciones</th>
              </tr>
              </thead>

                <tbody>
                  @foreach($administrativas as $administrativa)
                <tr>
                  <td>{{$administrativa->codigo_proyecto}}</td>
                  <td>{{$administrativa->nombre_proyecto}}
                  </td>
                  <td>{{$administrativa->fecha_contrato}}</td>
                  <td> {{$administrativa->cliente->nombre}}</td>
                  <td>{{$administrativa->valor_contrato_final}}</td>
                  <td>
                      <a href="{{ route('administrativas.edit', $administrativa->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-eye-open"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{ url('deleteadminstrativa') }}/{{ $administrativa->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>


                  </td>
                  <td></td>
                </tr>

                  @endforeach
                </tbody>

              <tfoot>
              <tr>
                <th>Codigo del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Fecha del contrato</th>
                <th>Cliente</th>
                <th>Valor final del contrato</th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Launch demo modal
      </button>
@endsection

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background= #fff;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


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
