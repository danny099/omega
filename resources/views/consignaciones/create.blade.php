


  <div class="container">
    <div class="">
      <div class="">
        <h3 class="box-title">Crear Clientes</h3>
      </div>


      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'consignaciones']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">
          <br>


            <div class="form-group">
              {!! Form::label('id', 'id') !!}
              {!! Form::number('id', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fecha_pago', 'Fecha de pago') !!}
              {!! Form::number('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('observaciones', 'Observaciones') !!}
              {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('contacto', 'Contacto') !!}
              {!! Form::text('contacto', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('telefono', 'Telefono') !!}
              {!! Form::number('telefono', null, ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('direccion', 'Direccion') !!}
              {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
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


      {!! Form::close() !!}
    </div>
  </div>
