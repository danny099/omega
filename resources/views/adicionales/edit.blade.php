
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title"> Editar valor adicional</h3> </center>
    </div>
    <div class="box-body">

      <form class="" action="{{ url('editar') }}" method="post">
      {{ csrf_field() }}
      @foreach($adicionales as $adici)
      <!-- {!! Form::model($adici, ['method' => 'PATCH', 'action' => ['ValorAdicionalController@update',$adici->id]]) !!} -->


      <input type="hidden" name="adicional[id][]" value="{{ $adici->id}}">
      <div class="col-md-12">

        <div class="col-md-3">
          <div class="form-group">
            <center><label >Valor adicional</label></center>
            <input type="text" class="form-control" placeholder= "Valor" name="adicional[valor][]" value="{{ $adici->valor }}">
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

      <!-- {!! Form::close() !!} -->
      @endforeach
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div>
      </form>
      <!-- <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
      </div> -->
    </div>
  </div>
