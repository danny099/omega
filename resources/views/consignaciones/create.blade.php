
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

            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('valor', 'Valor') !!}
              {!! Form::number('valor', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
              {!! Form::text('observaciones', null, ['class' => 'form-control' , 'required' => 'required']) !!}
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
