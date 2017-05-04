
@extends('index')

@section('contenido')


      <div class="container">
        <div class="col-md-12 well">
          <a class="btn btn-primary" data-toggle="modal" href="{{ url('administrativas/create') }}"><i class="fa fa-user-plus"></i> Crear Contrato</a>
          <a href="javascript:history.back()" class="btn btn-primary pull-right">Atras</a>
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
                @foreach($administrativas as $key => $administrativa)
                  <tr>
                    <td>{{$administrativa->codigo_proyecto}}</td>
                    <td>{{$administrativa->nombre_proyecto}}</td>
                    <td>{{$administrativa->fecha_contrato}}</td>
                    <td> {{$administrativa->cliente->nombre}}</td>
                    <td>{{$administrativa->valor_contrato_final}}</td>
                    <td>
                        <a href="{{ route('administrativas.edit', $administrativa->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('administrativas.show', $administrativa->id) }}" data-toggle="model" data-target="fade bs-example-modal-lg-{{ $key }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                        <a href="#myModal" data-toggle="modal" data-target=""><i class="fa fa-money"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('deleteadminstrativa') }}/{{ $administrativa->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                    </td>
                  </tr>
                  <!-- inicio modal 1 -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Pagos</h4>
                          </div>
                          <div class="modal-body">
                            <center><h4> ¿Desea anexar un pago? </h4></center>
                            <br>
                            <center>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" name="button">Consignacion</button>
                              <button type="button" class="btn btn-primary" name="button">Cuenta de Cobro</button>
                              <button type="button" class="btn btn-primary" name="button">Factura</button>
                            </center>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- fin modal -->
                </div>

                <!-- inicio modal 2 -->
                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">

                        <div class="modal-body">
                          @include('consignaciones.create')
                        </div>
                        <div class="modal-footer">

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- fin modal -->
              </div>

              <!-- /.modal-dialog -->
                  @endforeach
              </div>

              </tbody>
              <tfoot>

              </tfoot>
            </table>
          </div>




        <!-- /.modal -->


@endsection
@section('modales')

@endsection
<!-- Button trigger modal -->


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
