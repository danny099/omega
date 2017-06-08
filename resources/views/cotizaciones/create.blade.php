@extends('index')
<style media="screen">

  textarea{
    width:100%;
    resize: none;
  }

</style>
@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('inicio') }}">Inicio</a></li>
  <li class="active">Cotizaciones</li>
</ol>

  <div class="box box-primary" >
    <div class="box-header with-border">
      <center> <h3>Cotización</h3> </center>
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
  <form role="form" name="" action="" method="post" >
    {{ csrf_field() }}
    <div class="box-header with-border">
      <center> <h3>Alcance: proceso de transformación</h3> </center>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="transformacion[tipo][]">
              <option value="">Seleccione...</option>
              <option value="Tipo_poste">Tipo poste</option>
              <option value="Tipo_interior">Tipo interior</option>
              <option value="Tipo_exterior">Tipo exterior</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Nivel de tencion (kv)</label></center>
            <select class="form-control" name="transformacion[nivel_tension][]">
              <option value="">Seleccione...</option>
              <option value="13,2">13,2</option>
              <option value="13,4">13,4</option>
              <option value="13,8">13,8</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Capacidad</label></center>
              <input type="text" class="form-control" placeholder="Capacidad"   name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >refrigeración </label></center>
            <select class="form-control" name="transformacion[tipo_refrigeracion][]">
              <option value="">Seleccione...</option>
              <option value="Seco">Seco</option>
              <option value="Aceite">Aceite</option>
            </select>
          </div>
        </div>
        <div class="col-md-1 tblprod2" >
          <div class="form-group">
            <br>
            <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de distribución</h3> </center>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control" name="distribucion[descripcion_dis][]">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
            <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="distribucion[tipo_dis][]">
            <option value="">Seleccione...</option>
            <option value="Aérea">Tipo Aérea</option>
            <option value="Subterránea">Tipo subterránea</option>
            <option value="Aérea/subterránea">Aérea/subterránea</option>
          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">
        </div>
      </div>
      <div class="col-md-1 tblprod3" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripción</label></center>
          <select class="form-control"name="pu_final[descripcion_pu][]">
            <option value="">Seleccione...</option>
            <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
            <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="pu_final[tipo_pu][]">
            <option value="">Seleccione...</option>
            <option value="Casa">Casa</option>
            <option value="Apartamentos">Apartamentos</option>
            <option value="Zona común">Zona común</option>
            <option value="Local comercial">Local comercial</option>
            <option value="Punto fijo">Punto fijo</option>
          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
        </div>
      </div>
      <div class="col-md-1 tblprod4" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd4" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
      <div class="col-md-12">
        <center> <h3>Observaciones de estado administrativo del proyecto</h3> </center>
      </div>
      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="observacion" required=""></textarea>
      </div>
    </div>

  </form>
  </div>

@endsection
