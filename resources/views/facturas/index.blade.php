<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar factura</h3> </center>
  </div>
  <div class="box-body">
    <div class="col-md-12 well">
        <table id="example" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Numero factura</th>
              <th>Fecha de la factura</th>
              <th>Valor antes de iva</th>
              <th>Iva</th>
              <th>Valor con iva</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($facturas as $key => $factura)
            <tr>
              <td>{{$factura->num_factura}}</td>
              <td>{{$factura->fecha_factura}}</td>
              <td>{{ number_format($factura->valor_factura,0) }}</td>
              <td>{{ number_format($factura->iva,0) }}</td>
              <td>{{ number_format($factura->valor_total,0) }}</td>
              <td>
                <a href="" data-toggle="modal" data-target="#myModal20-{{ $key }}"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="{{ url('deletefactura') }}/{{ $factura->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                <!-- inicio modal 1 -->

                <div class="modal fade" id="myModal20-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('facturas.edit')
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
  </div>
