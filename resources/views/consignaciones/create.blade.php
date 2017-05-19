
  <div class="container">
    <div class="">
      <div class="">
        <h3 class="box-title">Consignacion</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'consignaciones']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('valor', 'Valor') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('valor', null, ['class' => 'form-control' , 'required' => 'required', 'min'=>'0','onkeypress'=>"mascara(this,cpf)"]) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
          </div>


            <input type="hidden" name="administrativa_id" value="{{ $administrativa->id}}">

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Enviar</button>
              <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left">Cancelar</button>
            </div>
        </div>
        <!-- /.box-body -->

      {!! Form::close() !!}
    </div>
  </div>


  @section('scripts')
  <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="../../plugins/input-mask/jquery.inputmask.js"></script>


  @endsection
