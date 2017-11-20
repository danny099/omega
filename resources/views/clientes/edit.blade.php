@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('clientes') }}">Cliente</a></li>
    <li class="active">Editar Clientes</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Editar clientes</h3>
      </div>
      @if(Session::has('message'))
        <div id="alert">
          <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
          <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
          </div>
        </div>
      @endif
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::model($clientes, ['method' => 'PATCH', 'action' => ['ClienteController@update',$clientes->id]]) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>

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
            {!! Form::text('cedula', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            <label >Departamento</label>
            <select class="form-control"  name="departamento_id" id="departamento">
              <option value="{{ $clientes->departamento->id }}">{{ $clientes->departamento->nombre }}</option>
              @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label >Municipios</label>
            <select class="form-control"  name="municipio" id="municipio">
              <option value="{{ $municipios->id }}">{{ $municipios->nombre }}</option>
              <option value=""></option>
            </select>
          </div>



        </div>
        <div class="box-body col-md-6">
          <br>

          <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::text('direccion', null, ['class' => 'form-control' ]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control' ]) !!}
          </div>


        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection

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
