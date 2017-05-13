@extends('index')
<style media="screen">
  .botoncito{
    width: 200px;
  }
  .div2{
    padding: 5px;
  }
</style>
@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('index') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li class="active">Editar Proyecto</li>
  </ol>
  <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Datos del proyecto</h3></center>

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
    {!! Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]) !!}
    {{ csrf_field() }}

    <div class="box-body">
      <div class="col-md-4">
        <div class="form-group">
          {!! Form::label('codigo_proyecto', 'Codigo del proyecto:') !!}
          {!! Form::text('codigo_proyecto', null, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('nombre', 'Nombre del proyecto') !!}
          {!! Form::text('nombre_proyecto', null, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('fecha_contrato', 'Fecha del contrato:') !!}
          {!! Form::date('fecha_contrato', null, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
        @if(empty($administrativas->juridica->id ))
        <div class="form-group" >
          <label >Tipo cliente</label>
          <select class="form-control" name="cliente_id" id="cliente" required="">
            <option value="1">Persona natural</option>
            <option value="2">Persona juridica</option>
          </select>
        </div>
        <div class="form-group"  id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
            <option value="{{ $administrativas->cliente->id }}">{{ $administrativas->cliente->nombre }}</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="Display:none" id="juridica">
          <label>Persona juridica</label>
          <select class="form-control" name="juridica_id" >
            <option value="">Seleccione</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
        @endif
        @if(empty($administrativas->cliente->id ))
        <div class="form-group" >
          <label >Tipo cliente</label>
          <select class="form-control" name="cliente_id" id="cliente" required="">
            <option value="2">Persona juridica</option>
            <option value="1">Persona natural</option>
          </select>
        </div>
        <div class="form-group" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" style="Display:none" name="cliente_id" style="width: 100%" id="select-natural">
            <option value="">Seleccione</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group"  id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" style="width: 100%" >
            <option value="{{ $administrativas->juridica->id }}">{{ $administrativas->juridica->razon_social }}</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
        @endif
        <div class="form-group">
          <label >Departamento</label>
          <select class="form-control" name="departamento" id="departamento">
            <option value="{{ $administrativas->departamento->nombre }}">{{ $administrativas->departamento->nombre }}</option>
            @foreach($departamentos as $departamento)
            <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label >Municipios</label>
          <select class="form-control" name="municipio" id="municipio">
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
            <option value=""></option>
          </select>
        </div>
      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Tipo de zona</label>
          <select class="form-control" name="zona">
            <option value="{{ $administrativas->tipo_zona }}">{{ $administrativas->tipo_zona }}</option>
            <option value="Urbana">Urbana</option>
            <option value="Rural">Rural</option>
          </select>
        </div>
        <div class="form-group">
          {!! Form::label('valor_contrato_inicial', 'Valor antes del iva') !!}
          {!! Form::number('valor_contrato_inicial', $administrativas->valor_contrato_inicial, ['class' => 'form-control' , 'required' => 'required', 'onkeyup'=>'sumar3()', 'min'=>'0']) !!}
        </div>
        <div class="form-group">
          <label >Valor iva</label>
          <input type="number" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor iva" name="iva" value="">
        </div>
        <div class="form-group ">
          <div class="form-group">

            <label >Valor contrato final</label>
            <input type="number" class="form-control" min="0" id="fin" readonly="readonly" placeholder= "Valor final" name="contrato_final" value="{{ $administrativas->valor_contrato_final}}">
          </div>
          <div class="form-group">
            <label >Plan de pago</label>
            <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago" value="{{ $administrativas->plan_pago}}">
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="col-md-12">
          <center><label >Editar/eliminar</label></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('adicionales.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Valor adicional</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('otrosi.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Otro si</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('pu_final.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Proceso uso final</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('distribuciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Alcance distribucion</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito" >Alcance transformacion</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('facturas.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Facturas</a></center>
        </div>
        <div class="col-md-12 div2">
          <center><a href="{{ route('cuenta_cobros.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Cuentas de cobro</a></center>
        </div>
        <div class="col-md-12 div2">
            <center><a href="{{ route('consignaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito">Consignaciones</a></center>
        </div>

        </div>
        <div class="col-md-12">
          <center> <h4 class="box-title">Observaciones de estado administrativo del proyecto</h4> </center>
        </div>
        <div class="col-md-12">
          <textarea  rows="4" cols="196" name="resumen"></textarea>
        </div>
      </div>
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
        </div>
      </div>

      <hr>
    </div>
  </div>


@endsection
@section('scripts')

<script type="text/javascript">
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
