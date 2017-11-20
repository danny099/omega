
<div class="container">
  <div class="">
    <div class="">
      <h3 >Crear persona natural</h3>
    </div>
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'clientes']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">

          <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nit', 'Nit') !!}
            {!! Form::text('nit', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cedula', 'Cédula') !!}
            {!! Form::text('cedula', null, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            <label >Departamento</label>
              <select class="form-control" name="departamento" style="width: 100%" id="departamento">
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
              <select class="form-control" name="municipio" style="width: 100%" id="municipio" >
                <option value=""></option>
              </select>
          </div>

          <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::text('direccion', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control' ]) !!}
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
            <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left" style="background-color: #33579A; border-color:#33579A;">Cancelar</button>
          </div>

        </div>
        <!-- /.box-body -->
        <br>
      </div>

      {!! Form::close() !!}
    </div>
  </div>

@section('scripts')
  <script type="text/javascript">
  //evento encargado de poner municipios de un departamento elegido
    $(document).ready(function(){
      $(document).on('change','#departamento',function(){

        var dep_id = $(this).val();
        var div = $(this).parents();
        var op=" ";
        $.ajax({
          type:'get',
          url:'{{ url('selectmuni')}}',
          data:{'id':dep_id},
          success:function(data){
            console.log(data);
            op+='<option value="0" selected disabled>Seleccione</option>';

            for (var i = 0; i < data.length; i++) {
              op+='<option value="' +data[i].id+ '">' +data[i].nombre+ '</option>'
            }

            div.find('#municipio').html(" ");
            div.find('#municipio').append(op);

          },
          error:function(){

          }
        });
      });
    });
  </script>
@endsection
