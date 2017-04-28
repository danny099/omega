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



        <!-- /.modal -->


@endsection
@section('modales')

  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Primary Modal</h4>
        </div>
        <div class="modal-body">
          <div class="box box-primary">
            <div class="box-header with-border">
              <center> <h3 class="box-title">Datos del proyecto</h3> </center>
            </div>
            @if(Session::has('message'))
              <div id="alert">
                <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
                <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{Session::get('message')}}
                </div>
              </div>
            @endif
            <!-- /.box-header -->
            <!-- form start -->

              {{ csrf_field() }}
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                    <label >Codigo del proyecto:</label>
                    <input id="phone" type="text" class="form-control" value="CPS-____-___" pattern="^\+CPS(\s+)?\(?(17|25|29|33|44)\)?(\s+)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$" // phones at Belarus placeholder="Ingrese codigo" name="codigo" required>


                  </div>
                  <div class="form-group">
                    <label >nombre del proyecto</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre">
                  </div>
                  <div class="form-group">
                    <label >Fecha del contrato:</label>
                    <input type="date" class="form-control" name="fecha">
                  </div>
                  <div class="form-group">
                    <label >Cliente</label>
                    <select class="form-control" name="cliente_id">
                      @foreach($clientes as $cliente)
                      <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label >Propietario</label>
                    <input type="text" class="form-control" placeholder="Ingresa propietario" name="propietario">
                  </div>

                  <div class="form-group">
                    <label >Departamento</label>
                    <select class="form-control" name="departamento">

                    </select>
                  </div>
                  <div class="form-group">
                    <label >Ciudad</label>
                    <select class="form-control" name="municipio">

                    </select>
                  </div>
                  <div class="form-group">
                    <label >Tipo de zona</label>
                    <select class="form-control" name="zona">

                    </select>
                  </div>
                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label >Valor contrato inicial</label>
                    <input type="number" class="form-control" placeholder= "Ingrese valor" name="contrato_inicial">
                  </div>
                  <label >Otro si</label>
                  <div class="form-group ">
                    <div class="col-md-11">
                      <input type="number" class="form-control" placeholder= "Ingrese valor" name="otrosi">
                    </div>

                    <div class="form-group">
                      <br>
                      <br>
                      <label >Valor contrato final</label>
                      <input type="number" class="form-control" placeholder= "Ingrese valor" name="contrato_final">
                    </div>
                    <div class="form-group">
                      <label >Plan de pago</label>
                      <input type="number" class="form-control" placeholder= "Ingrese valor" name="plan_pago">
                    </div>
                  </div>
                </div>
                <hr>

          </div>
          </div>


          <div class="box box-primary">
            <div class="box-header with-border">
              <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
            </div>

              <div class="box-body">
                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Descripcion</label></center>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="descripcion">

                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Tipo</label></center>
                    <select class="form-control" name="tipo">
                      <option value="tipo_poste">tipo poste</option>
                      <option value="tipo_interior">tipo interior</option>
                      <option value="tipo_exterior">tipo exterior</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Capacidad</label></center>
                    <select class="form-control" name="capacidad">
                      <option value="5KVA">5KVA</option>
                      <option value="10KVA">10KVA</option>
                      <option value="15KVA">15KVA</option>
                      <option value="150KVA">150KVA</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                    <center><label>Unidad</label></center>
                    <center>
                      <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_transformacion">
                    </center>
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                    <center><label >Cantidad</label></center>
                    <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad">
                  </div>
                </div>



                <div class="col-md-12">
                  <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Descripcion</label></center>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="descripcion_dis">
                      <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
                      <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Tipo</label></center>
                    <select class="form-control" name="tipo_dis">
                      <option value="aerea">tipo Aerea</option>
                      <option value="subterranea">tipo subterranea</option>

                    </select>
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <center><label >Unidad</label></center>
                    <center>
                      <input type="text" class="form-control" value="km"  readonly=”readonly” name="unidad_distribucion"style="text-align:center">
                    </center>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <center><label >Cantidad</label></center>
                    <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_dis">
                  </div>
                </div>



                <div class="col-md-12">
                  <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Descripcion</label></center>
                  </div>
                  <div class="form-group">
                    <select class="form-control"name="descripcion_pu">
                      <option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option>
                      <option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <center><label >Tipo</label></center>
                    <select class="form-control" name="tipo_pu">
                      <option value="Casa">Casa</option>
                      <option value="Apartamentos">Apartamentos</option>
                      <option value="Zona comun">Zona comun</option>
                      <option value="Local comercial">Local comercial</option>
                      <option value="Punto fijo">Punto fijo</option>

                    </select>
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <center><label >Unidad</label></center>
                    <center>
                      <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_pu_final">
                    </center>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <center><label >Cantidad</label></center>
                    <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_pu">
                  </div>
                </div>



                <div class="col-md-12">
                  <center> <h4 class="box-title">Resumen de estado administrativo del proyecto</h4> </center>
                </div>

                <div class="col-md-12">
                  <center><textarea name="name" rows="4" cols="100" name="resumen"></textarea></center>
                </div>
              </div>


            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

  </div>
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
