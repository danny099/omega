<div class="container">
  <div class="">
    <div class="">
      <h3 class="box-title">Crear persona juridica</h3>
    </div>
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'juridica']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">

          <div class="form-group">
            {!! Form::label('razon', 'Razon social') !!}
            {!! Form::text('razon', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nit', 'Nit') !!}
            {!! Form::number('nit', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nombre', 'Nombre representante legal') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cedula', 'Cedula') !!}
            {!! Form::number('cedula', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            <label >Departamento</label>
              <select class="form-control" name="departamento" style="width: 100%" id="departamento" required="">
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
              <select class="form-control" name="municipio" style="width: 100%" id="municipio" required="">
                <option value=""></option>
              </select>
          </div>

          <div class="form-group">
            {!! Form::label('direccion', 'Direccion') !!}
            {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('telefono', 'Telefono') !!}
            {!! Form::number('telefono', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Enviar</button>
            <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left">Cancelar</button>
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
