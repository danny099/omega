<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar observacion</h3> </center>
  </div>
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'observacion']) !!}
        {{ csrf_field() }}
        <div class="box-body">

          <div class="col-md-2">
            <div class="form-group">
              {!! Form::label('observacion', 'Observacion') !!}
            </div>
          </div>
          <div class="col-md-10">
            <div class="form-group">
              <td><textarea  rows="4" cols="60" name="resumen" ></textarea></td>
            </div>
          </div>


          <div class="box-footer">
            <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Crear</button>
          </div>
        </div>

        </div>
        <!-- /.box-body -->
        <br>
      </div>

      {!! Form::close() !!}
    </div>
