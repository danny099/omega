
  <div class="container">
    <div class="">
      <div class="">

        <h3 >Consignación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Saldo: ${{ number_format($administrativa->saldo,0) }}</h3>

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
              {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required', 'style'=>'width:110%']) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('valor', 'Valor antes de IVA') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('valor', null, ['class' => 'form-control valor' , 'required' => 'required', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('iva', 'IVA') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('valor_iva', null, ['class' => 'form-control iva' , 'readonly','required' => 'required', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]) !!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('valor_total', 'Valor total') !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::text('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]) !!}
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

          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>

            <input type="hidden" name="administrativa_id" value="{{ $administrativa->id}}">

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
              <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left" style="background-color: #33579A; border-color:#33579A;">Cancelar</button>
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
