<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3>Alcance: proceso de uso final</h3> </center>
  </div>
  <div class="box-body">
    <form class="form1" action="{{ url('editarpu') }}" method="post">
      {{ csrf_field() }}

    @foreach($pu_finales as $pu)
      <input type="hidden" name="pu_final[id][]" value="{{ $pu->id}}">
      <div class="col-md-12">
        <div class="col-md-4">
          <div class="form-group">
            <center><label >Descripción</label></center>
            <select class="form-control"name="pu_final[descripcion_pu][]">
              <option value="{{ $pu->descripcion }}">{{ $pu->descripcion }}</option>
              <option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>
              <option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Tipo</label></center>
            <select class="form-control" name="pu_final[tipo_pu][]">
              <option value="{{ $pu->tipo }}">{{ $pu->tipo }}</option>
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
            <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]" value="{{ $pu->cantidad }}">
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
    </form>
  </div>
</div>

<!-- <script>
  $(document).ready(function() {


  // Interceptamos el evento submit
  $('.form1').on('submit',function() {
// Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
          // Mostramos un mensaje con la respuesta de PHP
            success: function() {
              alert('Alcance de distribucion editado');
              $('.modal').modal('hide');
            }
        })
        return false;
    });
  });
 -->

<!-- </script> -->
