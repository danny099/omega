@extends('index')
@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Crear Proyecto</li>
</ol>
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3> </center>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
    <div class="box-body">
      <div class="col-md-4">
        <div class="form-group">
          <label >Codigo del proyecto:</label>
          <input id="phone" type="text" readonly="readonly" class="form-control" value="{{ $administrativa->codigo_proyecto}}" pattern="^\+CPS(\s+)?\(?(17|25|29|33|44)\)?(\s+)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$" // phones at Belarus placeholder="Ingrese codigo" name="codigo" required>
        </div>
        <div class="form-group">
          <label >nombre del proyecto</label>
          <input type="text" class="form-control" readonly="readonly" placeholder="Ingrese nombre" name="nombre" value="{{ $administrativa->nombre_proyecto}}">
        </div>
        <div class="form-group">
          <label >Fecha del contrato:</label>
          <input type="date" class="form-control" readonly="readonly" name="fecha" value="{{ $administrativa->fecha_contrato}}">
        </div>
        <div class="form-group">
          <label >Cliente</label>
          <input type="text" class="form-control" readonly="readonly" name="cliente_id" value="{{ $administrativa->cliente->nombre}}">
        </div>

      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label >Propietario</label>
          <input type="text" class="form-control" readonly="readonly" placeholder="Ingresa propietario" name="propietario" value="{{ $administrativa->propietario}}">
        </div>

        <div class="form-group">
          <label >Departamento</label>
          <input type="text" class="form-control" readonly="readonly" placeholder="" name="departamento" value="{{ $administrativa->departamento->nombre }}">
        </div>
        <div class="form-group">
          <label >Ciudad</label>
          <input type="text" class="form-control" readonly="readonly" placeholder="" name="departamento" value="{{ $administrativa->departamento->municipio->nombre }}">
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
          <input type="number" class="form-control" readonly="readonly" placeholder= "Ingrese valor" name="contrato_inicial" value="{{ $administrativa->valor_contrato_inicial}}">
        </div>
        <label >Otro si</label>
        <div class="form-group ">
          <div class="col-md-11">
            <input type="number" class="form-control" readonly="readonly" placeholder= "Ingrese valor" name="otrosi" value="">
          </div>

          <div class="form-group">
            <br>
            <br>
            <label >Valor contrato final</label>
            <input type="number" class="form-control" readonly="readonly" placeholder= "Ingrese valor" name="contrato_final"  value="{{ $administrativa->valor_contrato_final}}">
          </div>
          <div class="form-group">
            <label >Plan de pago</label>
            <input type="number" class="form-control" readonly="readonly" placeholder= "Ingrese valor" name="plan_pago" value="{{ $administrativa->plan_pago}}">
          </div>
        </div>
      </div>
      <hr>

</div>
</div>


  <div class="box box-primary">
      <div class="">
        @if($administrativa->transformacion_id != null)
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
                  <input type="text" class="form-control" readonly="readonly" placeholder= "" name="cantidad" value="{{ $administrativa->transformacion->tipo }}">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Capacidad</label></center>
                <input type="text" class="form-control" readonly="readonly" placeholder= "" name="cantidad" value="{{ $administrativa->transformacion->capacidad }}">
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center><label>Unidad</label></center>
                <center>
                  <input style="text-align:center;" type="text" readonly="readonly" class="form-control" value="Und"  readonly=”readonly” name="unidad_transformacion">
                </center>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center><label>Cantidad</label></center>
                <input type="text" class="form-control" readonly="readonly" placeholder= "" name="cantidad" value="{{ $administrativa->transformacion->cantidad }}">
              </div>
            </div>

      </div>
      @endif

      <div class="">
        @if($administrativa->distribucion_id != null)

        <div class="col-md-12">
          <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label>Descripcion</label></center>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" readonly="readonly" placeholder= "" name="" value="{{ $administrativa->distribucion->descripcion}}">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label>Tipo</label></center>
            <input type="text" class="form-control" readonly="readonly" placeholder= "" name="" value="{{ $administrativa->distribucion->tipo}}">
          </div>
        </div>



        <div class="col-md-2">
          <div class="form-group">
            <center><label>Unidad</label></center>
            <center>
              <input type="text" class="form-control" value="km"  readonly=”readonly” name="unidad_distribucion"style="text-align:center">
            </center>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <center><label>Cantidad</label></center>
            <input type="text" class="form-control" readonly="readonly" placeholder= "" name="cantidad_dis" value="{{ $administrativa->distribucion->cantidad}}">
          </div>
        </div>
        @endif
      </div>

      <div class="">
        @if($administrativa->pu_final_id != null)

          <div class="col-md-12">
            <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <center><label>Descripcion</label></center>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" readonly="readonly" placeholder= "" name="" value="{{ $administrativa->pu_final->descripcion }}">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <center><label>Tipo</label></center>
              <input type="text" class="form-control" readonly="readonly" placeholder= "" name="" value="{{ $administrativa->pu_final->tipo }}">
            </div>
          </div>



          <div class="col-md-2">
            <div class="form-group">
              <center><label>Unidad</label></center>
              <center>
                <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="unidad_pu_final">
              </center>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <center><label>Cantidad</label></center>
              <input type="text" class="form-control" readonly="readonly" placeholder= "" name="cantidad_pu" value="{{ $administrativa->pu_final->cantidad }}">
            </div>
          </div>
        @endif
      </div>



      <div class="col-md-12">
        <center> <h4 class="box-title">Resumen de estado administrativo del proyecto</h4></center>
      </div>

      <div class="col-md-12">
        <center><textarea name="name" rows="4" cols="100" name="resumen">{{ $administrativa->resumen}}</textarea></center>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Cerrar</button>
    </div>

  </div>

@endsection
