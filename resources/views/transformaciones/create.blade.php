@extends('index')

@section('contenido')
  <form class="" action="{{ url('transformaciones') }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="id_admin" value="{{ $id }}">

    <div class="box box-primary">
      <div class="box-header with-border">
        <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
      </div>

    <div class="box-body">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripcion</label></center>
            <input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="transformacion[tipo][]">
              <option value="">Seleccione..</option>
              <option value="tipo_poste">tipo poste</option>
              <option value="tipo_interior">tipo interior</option>
              <option value="tipo_exterior">tipo exterior</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Capacidad</label></center>
            <select class="form-control" name="transformacion[capacidad][]">
              <option value="">Seleccione..</option>
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
              <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]">
            </center>
          </div>
        </div>

        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]">
          </div>
        </div>

        <div class="col-md-1" id="tblprod2">
          <div class="form-group">
            <br>
            <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
      Guardar
    </button>
  </form>
@endsection
