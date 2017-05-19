
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar consignaiones</h3> </center>
  </div>
  <div class="box-body">
      <form class="form1" action="{{ url('editarconsignacion') }}" method="post">
        {{ csrf_field() }}

      @foreach($consignaciones as $consignacion)
      {{ csrf_field() }}
      <input type="hidden" name="id" value="{{$consignacion->id}}">
        <div class="box-body col-md-12">

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="date" name="consignacion[fecha_pago][]" class="form-control" required="" value="{{ $consignacion->fecha_pago }}">
              <!-- {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('valor', 'Valor') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[valor][]" class="form-control" onkeypress="mascara(this,cpf)" required="" value="{{ $consignacion->valor }}">


              <!-- {!! Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0']) !!} -->
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="consignacion[observaciones][]" class="form-control" required="" value="{{ $consignacion->observacioness}}">
              <!-- {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!} -->
            </div>
          </div>

        <div class="box-footer">
          <a href="{{ url('deleteconsignacion') }}/{{ $consignacion->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
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
  <script>
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
                alert('Valor adicional editado');
                $('.modal').modal('hide');
              }
          })
          return false;
      });
    });
  </script>
