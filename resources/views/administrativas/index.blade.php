@extends('index')



@section('contenido')
    <ol class="breadcrumb">
      <li><a href="{{ url('index') }}">Inicio</a></li>
      <li class="active">Administrativa</li>
    </ol>

    <div class="col-md-12 well">
      <a class="btn btn-primary" data-toggle="modal" href="{{ url('administrativas/create') }}"><i class="fa fa-user-plus"></i> Crear Contrato</a>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Codigo del proyecto</th>
              <th>Nombre del proyecto</th>
              <th>Fecha del contrato</th>
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
              <td>{{$administrativa->valor_contrato_final}}</td>
              <td>
                <a href="{{ route('administrativas.edit', $administrativa->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="{{ route('administrativas.show', $administrativa->id) }}" data-toggle="model" data-target="show-{{ $key }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="#myModal-{{ $key }}" data-toggle="modal" data-target=""><i class="fa fa-money"></i></a>
                <a href="{{ url('deleteadminstrativa') }}/{{ $administrativa->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                <!-- inicio modal 1 -->
                <div class="modal fade" id="myModal-{{ $key }}" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pagos</h4>
                      </div>
                      <div class="modal-body">
                        <center><h4> ¿Desea anexar un pago? </h4></center>
                        <br>
                        <center>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2-{{ $key }}" name="button">Consignacion</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3-{{ $key }}" name="button">Cuenta de Cobro</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4-{{ $key }}" name="button">Factura</button>
                        </center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal2-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('consignaciones.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal3-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('cuenta_cobros.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal4-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('facturas.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection
@section('scripts')
  <script type="text/javascript">

    $(function() {
      $('table').DataTable();

      $('.valor_factura').keyup(function(){
          var valor = parseInt($(this).val());
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          alert('holaa');
          $(this).parent().parent().parent().find('.iva').val(iva);
          $(this).parent().parent().find('.valor_total').val(resultado);
      });

    });

  </script>
@endsection
