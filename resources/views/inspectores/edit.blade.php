@extends('index')
<style media="screen">
  #password{
    width: 90%;
  }
  #rol_id{
     width: 100%;
   }
   .thumb {
   height: 130px;
   border: 1px solid #000;
   margin: 10px 5px 0 0;
   position: absolute;
     top: -40;
   }
</style>
@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
    <li class="active">Editar Usuario</li>
  </ol>
  <div class="container">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Editar Usuario</h3>
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
        {!! Form::model($inspector, ['method' => 'PATCH', 'action' => ['InspectoresController@update',$inspector->id],'enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="row">
        <div class="box-body col-md-12">
          <br>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('nombres', 'Nombres') !!}
              {!! Form::text('nombres', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('apellidos', 'Apellidos') !!}
              {!! Form::text('apellidos', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>
        </div>
        <div class="box-body col-md-12">
          <div class="col-md-6">

            <div class="form-group">
              {!! Form::label('matricula', 'Matricula') !!}
              {!! Form::text('matricula', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>


            <div class="col-md-6">
              <label for="">Rol inspector</label>
              <select class="form-control" name="rol_inspector">
                <option value="{{$inspector->rol_inspector}}">{{$inspector->rol_inspector}}</option>
                <option value="rol1">rol1</option>
                <option value="rol2">rol2</option>
              </select>
            </div>

        </div>

        </div>
        <!-- /.box-body -->
        <br>
        <div class="box-footer" style="width">
          <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">
  function archivo(evt) {
  var files = evt.target.files; // FileList object

  // Obtenemos la imagen del campo "file".
  for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
    if (!f.type.match('image.*')) {
    continue;
    }

    var reader = new FileReader();

    reader.onload = (function(theFile) {
    return function(e) {
      // Insertamos la imagen
     document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
    };
    })(f);

    reader.readAsDataURL(f);
  }
  }

  document.getElementById('files').addEventListener('change', archivo, false);
  $(document).ready(function () {
     $('#show-pass').click(function () {
      if ($('#password').attr('type') === 'text') {
       $('#password').attr('type', 'password');
      } else {
       $('#password').attr('type', 'text');
      }
     });
    });
  </script>

@endsection
