<form action="{{ url('editaradicionales') }}" method="post" autocomplete="off">
  {{ csrf_field() }}
  @foreach($adicionales as $adici)
  <input type="hidden" name="adicional[id][]" value="{{ $adici->id}}">
  <div class="col-md-12">

    <div class="col-md-3">
      <div class="form-group">
        <center><label >Valor adicional</label></center>
        <input type="text" class="form-control" placeholder= "Valor" name="adicional[valor][]" onkeypress="mascara(this,cpf)" value="{{ number_format($adici->valor,0) }}">
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <center><label >Detalle</label></center>
        <input type="text" class="form-control" placeholder= "Detalle" name="adicional[detalle][]" value="{{ $adici->detalle }}">
      </div>
    </div>

    <div class="box-footer">
      <a href="{{ url('deleteadicional') }}/{{ $adici->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
    </div>
  </div>

  @endforeach
  <div class="box-footer">
    <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
  </div>
</form>
