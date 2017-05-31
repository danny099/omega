@extends('index')

@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li class="active">Crear uso final</li>
</ol>
  <form class="" action="{{ url('pu_final') }}" method="post">
    {{ csrf_field() }}
    <div class="box box-primary">
      <div class="col-md-12">
        <center> <h3>Alcance: proceso de uso final</h3> </center>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <center><label >Código Proyecto</label></center>
                <select class="form-control select2" name="codigo_proyecto" style="width: 100%" id="select" required="">
                  <option value="">Seleccione...</option>
                  @foreach($codigos as $codigo)
                  <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                  @endforeach
                </select>
              </div>
          </div>
        </ddiv>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <center><label >Descripción</label></center>
                <select class="form-control"name="pu_final[descripcion_pu][]">
                  <option value="">Seleccione...</option>
                  <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
                  <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
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
                <center><label >Unidad</label></center>
                <center>
                  <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]">
                </center>
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
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary pull-right">
        Guardar
      </button>
    </div>
  </form>
@endsection
