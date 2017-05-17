  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
    </div>
    <div class="box-body">
      <form class="" action="{{ url('editard') }}" method="post">
        {{ csrf_field() }}
      @foreach($distribuciones as $distribucion)
        <input type="hidden" name="distribucion[id][]" value="{{ $distribucion->id}}">
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <center><label >Descripcion</label></center>
              <select class="form-control" name="distribucion[descripcion][]">
                <option value="{{ $distribucion->descripcion }}">{{ $distribucion->descripcion }}</option>
                <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
                <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control" name="distribucion[tipo][]">
                <option value="{{ $distribucion->tipo }}">{{ $distribucion->tipo }}</option>
                <option value="aerea">tipo Aerea</option>
                <option value="subterranea">tipo subterranea</option>
                <option value="aerea/subterranea">Aerea/Subterranea</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <center><label >Unidad</label></center>
              <center>
                <input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad][]"style="text-align:center">
              </center>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <!-- {!! Form::label('cantidad_dis', 'Cantidad') !!}
              {!! Form::text('cantidad', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
              <center><label >Cantidad</label></center>
              <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]" value="{{ $distribucion->cantidad }}">
            </div>
          </div>

          <div class="box-footer">
            <a href="{{ url('deletedistri') }}/{{ $distribucion->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>

          </div>
        </div>
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
      </form>
    </div>
  </div>
