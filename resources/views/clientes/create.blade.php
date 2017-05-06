
<div class="container">
  <div class="">
    <div class="">
      <h3 class="box-title">Crear persona natural</h3>
    </div>
      <!-- /.box-header -->
      <!-- form start -->
        {!! Form::open(['url' => 'clientes']) !!}
        {{ csrf_field() }}
        <div class="box-body col-md-6">

          <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('nit', 'Nit') !!}
            {!! Form::number('nit', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cedula', 'Cedula') !!}
            {!! Form::number('cedula', null, ['class' => 'form-control' , 'required' => 'required']) !!}
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
