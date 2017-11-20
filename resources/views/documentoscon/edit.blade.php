@extends('index')

@section('contenido')


  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('documentos') }}">Documentos</a></li>
    <li class="active">Editar Documento</li>
  </ol>
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">

              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              {!! Form::model($documento, ['method' => 'PATCH', 'action' => ['DocumentoController@update',$documento->id]]) !!}

                {{ csrf_field() }}
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <label for="">Nombre:</label>
                      <input type="text" name="nombre" class="form-control" value="{{ $documento->nombre }}">
                      <br>
                    </div>
                    <div class="col-md-3">
                      <p for="">Importante: se debe organizar el contenido tal cual como quiere que se vea en la página  web</p>
                      <br>
                    </div>
                    <div class="col-md-12">
                      <textarea id="editor1" name="editor1" rows="10" cols="80">
                        {{ $documento->detalles }}
                      </textarea>
                      <br>

                    </div>
                  </div>

                    <button type="submit" data-target="" data-toggle="  " class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
              </form>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->

      <!-- ./row -->
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
  });
</script>
@endsection
