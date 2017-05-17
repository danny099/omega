<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
  </div>
  <div class="box-body">
    @foreach($pu_finales as $pu)
    {!! Form::model($pu, ['method' => 'PATCH', 'action' => ['Pu_finalController@update',$pu->id]]) !!}
    {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $pu->id}}">
      <div class="col-md-12">
        <div class="col-md-3">
          <div class="form-group">
            <center><label >Descripcion</label></center>
            <select class="form-control"name="descripcion_pu">
              <option value="{{ $pu->descripcion }}">{{ $pu->descripcion }}</option>
              <option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option>
              <option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="tipo_pu">
              <option value="{{ $pu->tipo }}">{{ $pu->tipo }}</option>
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
            <input type="text" class="form-control" placeholder= "Cantidad" name="cantidad_pu" value="{{ $pu->cantidad }}">
          </div>
        </div>
        <div class="box-footer">
          <a href="{{ url('deletepu') }}/{{ $pu->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>

        </div>
      </div>
    @endforeach
    <div class="box-footer">
      <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
    </div>
  </div>
</div>
