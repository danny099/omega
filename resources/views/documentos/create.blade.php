@extends('index')

@section('contenido')


  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">




        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">

              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form form role="form" name="form1" action="{{ url('documentos') }}" method="post" >
                {{ csrf_field() }}
                  <div class="col-md-12">
                    <div class="col-md-3">
                      <label for="">Nombre:</label>
                      <input type="text" name="nombre" class="form-control" value="">
                      <br>
                    </div>
                    <div class="col-md-12">
                      <textarea id="editor1" name="editor1" rows="10" cols="80">
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
