<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar otrosi</h3> </center>
  </div>
  <div class="box-body">
    <div class="col-md-12 well">

        <table id="example" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Valor antes de iva</th>
              <th>Iva</th>
              <th>Valor con iva</th>
              <th>detalles</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($otrosis as $key => $otro)
            <tr>
              <td>{{$otro->valor}}</td>
              <td>{{$otro->iva}}</td>
              <td>{{$otro->valor_tot}}</td>
              <td>{{$otro->detalles}}</td>
              <td>
                <a href="{{ route('otrosi.edit', $otro->id) }}" data-toggle="modal" data-target="#myModal21-{{ $key }}"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="{{ url('deleteotrosi') }}/{{ $otro->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                <!-- inicio modal 1 -->

                <div class="modal fade" id="myModal21-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('otrosi.edit')
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
