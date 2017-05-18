@extends('index')
<style media="screen">
  .botoncito{
    width: 200px;
  }
  .div2{
    padding: 5px;
  }

</style>
@section('scripts')
  <script type="text/javascript">

    $(function() {
      $('table').DataTable();

      $('.valor_factura').keyup(function(){
          var valor = parseInt($(this).val());
          var resultado = valor * 1.19;
          var iva = valor*0.19;

          $(this).parent().parent().parent().find('.iva').val(iva);
          $(this).parent().parent().parent().find('.valor_total').val(resultado);
      });

      $('.retencionesporcen').keyup(function(){
        var retencionesporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().parent().find('.valor_factura').val());
        var resultado = valor*retencionesporcen/100;
        $(this).parent().parent().find('.retenciones').val(resultado);
      });

      $('.retencionesporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.amortizacionporcen').keyup(function(){
        var amortizacionporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado = valor*amortizacionporcen/100;
        $(this).parent().parent().parent().find('.amortizacion').val(resultado);
      });

      $('.amortizacionporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.polizasporcen').keyup(function(){
        var polizasporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado = valor*polizasporcen/100;
        $(this).parent().parent().parent().find('.polizas').val(resultado);
      });

      $('.polizasporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.retegarantiaporcen').keyup(function(){
        var retegarantiaporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado = valor*retegarantiaporcen/100;
        $(this).parent().parent().parent().find('.retegarantia').val(resultado);
      });

      $('.retegarantiaporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.retencionesporcen').focus(function(){
        var retenciones = parseInt($(this).val(""));

      });

      $('.amortizacionporcen').focus(function(){
        var amortizacion = parseInt($(this).val(""));
      });

      $('.polizasporcen').focus(function(){
        var polizas = parseInt($(this).val(""));
      });

      $('.retegarantiaporcen').focus(function(){
        var retegarantia = parseInt($(this).val(""));
      });

    });

  </script>
@endsection
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
          <select class="form-control" name="departamento_id" id="departamento">
            <option value="{{ $administrativas->departamento->id }}">{{ $administrativas->departamento->nombre }}</option>
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
            <option value="Urbana/Rural">Urbana/Rural</option>
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
        @if(count($adicionales) == 0)
        <div class="col-md-12 div2">
            <center><a  class="btn btn-primary botoncito" disabled>Valor adicional</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('adicionales.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal2" >Valor adicional</a></center>
        </div>
        @endif
        @if(count($otrosis) == 0)
        <div class="col-md-12 div2">
            <center><a class="btn btn-primary botoncito" disabled>Otro si</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('otrosi.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal8">Otro si</a></center>
        </div>
        @endif
        @if(count($pu_finales) == 0)
        <div class="col-md-12 div2">
            <center><a  class="btn btn-primary botoncito" disabled>Proceso uso final</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('pu_final.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal5">Proceso uso final</a></center>
        </div>
        @endif
        @if(count($distribuciones) == 0)
        <div class="col-md-12 div2">
            <center><a class="btn btn-primary botoncito" disabled>Alcance distribucion</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('distribuciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal4">Alcance distribucion</a></center>
        </div>
        @endif
        @if(count($transformaciones) == 0)
        <div class="col-md-12 div2">
            <center><a  class="btn btn-primary botoncito" disabled >Alcance transformacion</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal3" >Alcance transformacion</a></center>
        </div>
        @endif
        @if(count($facturas) == 0)
        <div class="col-md-12 div2">
            <center><a class="btn btn-primary botoncito" disabled>Facturas</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('facturas.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal" >Facturas</a></center>
        </div>
        @endif
        @if(count($cuenta_cobros) == 0)
        <div class="col-md-12 div2">
          <center><a class="btn btn-primary botoncito" disabled>Cuentas de cobro</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
          <center><a href="{{ route('cuenta_cobros.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal6">Cuentas de cobro</a></center>
        </div>
        @endif
        @if(count($consignaciones) == 0)
        <div class="col-md-12 div2">
            <center><a class="btn btn-primary botoncito" disabled>Consignaciones</a></center>
        </div>
        @else
        <div class="col-md-12 div2">
            <center><a href="{{ route('consignaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal7">Consignaciones</a></center>
        </div>
        @endif

        </div>
        <div class="col-md-12">
          <center> <h4 class="box-title">Observaciones de estado administrativo del proyecto</h4> </center>
        </div>
        <div class="col-md-12">
          <textarea  rows="4" cols="196" name="resumen"  value="{{ $administrativas->resumen }} "></textarea>
        </div>
      </div>
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
        </div>
      </div>

      <hr>
    </div>
  </div>
  <!-- inicio modal  -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('facturas.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal2  -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('adicionales.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal3  -->
  <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg2" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('transformaciones.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal4  -->
  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg2" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('distribuciones.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal5  -->
  <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg2" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('pu_final.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal6  -->
  <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('cuenta_cobros.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal7  -->
  <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('consignaciones.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->

  <!-- inicio modal8  -->
  <div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          @include('otrosi.edit')
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- fin modal -->
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
