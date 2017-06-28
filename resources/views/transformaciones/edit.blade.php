
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3>Alcance: proceso de transformación</h3> </center>
    </div>
    <div class="box-body">

      <form class="form1" action="{{ url('editart') }}" method="post">
      {{ csrf_field() }}

      @foreach($transformaciones as $transfor)
      <input type="hidden" name="transformacion[id][]" value="{{ $transfor->id}}">
      <div class="row quitar50" id="quitar50">
        <center> <h3>Alcance: proceso de transformación</h3> </center>

      <div class="col-md-12">
        <div class="col-md-3">
          <input type="hidden"  name="transformacion[id][]" value="{{$transfor->id}}"  >
          <div class="form-group">
            <center><label >Descripción</label></center>
            <input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control tipo" name="transformacion[tipo][]" style="width:100%">
              <option value="{{ $transfor->tipo }}">{{ $transfor->tipo }}</option>
              <option value="Tipo_poste">Tipo poste</option>
              <option value="Tipo_interior">Tipo interior</option>
              <option value="Tipo_pedestal/jardin">Tipo pedestal/jardin</option>
              <option value="Tipo_patio">Tipo Patio</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Nivel de tensión (kv)</label></center>
            <select class="form-control" name="transformacion[nivel_tension][]" style="width:100%">
              <option value="{{ $transfor->nivel_tension }}">{{ $transfor->nivel_tension }}</option>
              <option value="13,2">13,2</option>
              <option value="13,4">13,4</option>
              <option value="13,8">13,8</option>
            </select>
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Capacidad</label></center>
              <input type="text" class="form-control capacidad" placeholder="Capacidad"   value="{{$transfor->capacidad}}" name="transformacion[capacidad][]">
          </div>
        </div>
        <div class="col-md-1">
          <div class="form-group">
            <center><label >Cantidad</label></center>
            <input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" value="{{$transfor->cantidad}}"  name="transformacion[cantidad][]">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <center><label >Refrigeración </label></center>
            <select class="form-control" name="transformacion[tipo_refrigeracion][]" style="width:100%">
              <option value="{{ $transfor->tipo_refrigeracion }}">{{ $transfor->tipo_refrigeracion }}</option>
              <option value="Seco">Seco</option>
              <option value="Aceite">Aceite</option>
            </select>
          </div>
        </div>
    </div>
  </div>

      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
      </form>
    </div>
  </div>
