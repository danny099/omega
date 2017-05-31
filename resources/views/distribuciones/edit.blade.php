
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Alcance: proceso de distribución</h3> </center>
    </div>
    <div class="box-body">
      <form class="form1" action="{{ url('editard') }}" method="post">
        {{ csrf_field() }}
      @foreach($distribuciones as $distribucion)
        <input type="hidden" name="distribucion[id][]" value="{{ $distribucion->id}}">
        <div class="col-md-12">
          <div class="col-md-4">
            <div class="form-group">
              <center><label >Descripción</label></center>
              <select class="form-control" name="distribucion[descripcion_dis][]">
                <option value="{{ $distribucion->descripcion }}">{{ $distribucion->descripcion }}</option>
                <option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>
                <option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <center><label >Tipo</label></center>
              <select class="form-control" name="distribucion[tipo_dis][]">
                <option value="{{ $distribucion->tipo }}">{{ $distribucion->tipo }}</option>
                <option value="Aérea">tipo Aérea</option>
                <option value="Subterránea">tipo subterránea</option>
                <option value="Aérea/subterránea">Aérea/Subterránea</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <center><label >Unidad</label></center>
              <center>
                <input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center">
              </center>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <!-- {!! Form::label('cantidad_dis', 'Cantidad') !!}
              {!! Form::text('cantidad', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
              <center><label >Cantidad</label></center>
              <input type="number" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]" value="{{ $distribucion->cantidad }}">
            </div>
          </div>

          <div class="box-footer">
            <a href="{{ url('deletedistri') }}/{{ $distribucion->id }}" onClick="eliminar()"><i class="glyphicon glyphicon-minus-sign"></i></a>

          </div>
        </div>
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
      </form>
    </div>
  </div>
