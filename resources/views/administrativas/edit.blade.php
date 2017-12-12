@extends('index')
<style media="screen">
  .botoncito{
    width: 200px;
  }
  .div2{
    padding: 5px;
  }
  textarea{
    width:100%;
    resize: none;
  }
  select{
    width:100%;
  }

</style>
@section('scripts')
  <script type="text/javascript">
  //evento encargado de poner municipios de un departamento elegido
  $(document).ready(function(){
      var dep_id = $('#departamento').val();
      var div = $('#departamento').parents();
      var op=" ";
      $.ajax({
        type:'get',
        url:'{{ url('selectmuni')}}',
        data:{'id':dep_id},
        success:function(data){
        console.log(data);
        op+='@for ($i = 0; $i <  count($array_muni); $i++)';
        op+='<?php $municipios= $array_muni[$i];?>';
        op+='@foreach($municipios as $muni)';
        op+='<option value="{{ $muni->id}}" selected>{{ $muni->nombre}}</option>';
        op+='@endforeach';
        op+='@endfor';

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

  $(function () {
    $("table").DataTable({
      "language":{
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }
 });
  });
  //script encargado de poner los separadores de miles.
    function mascara(o,f){
      v_obj=o;
      v_fun=f;
      setTimeout("execmascara()",1);
    }
    function execmascara(){
      v_obj.value=v_fun(v_obj.value);
    }
    function cpf(v){
      v=v.replace(/([^0-9\.]+)/g,'');
      v=v.replace(/^[\.]/,'');
      v=v.replace(/[\.][\.]/g,'');
      v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2');
      v=v.replace(/\.(\d{1,2})\./g,'.$1');
      v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');
      v = v.split('').reverse().join('').replace(/^[\,]/,'');
      return v;
    }
    function calcular(){
      var varMonto;
      var varIva;
      var varSubTotal;

      varMonto = document.getElementById("fin").value;
      varMonto = varMonto.replace(/[\,]/g,'');

      varIva = parseFloat(varMonto) / 1.19;
      document.getElementById("valor_contrato_inicial").value = addCommas(Math.round(varIva)) ;

      varSubTotal = parseFloat(varMonto) - parseFloat(varIva);
      document.getElementById("iva").value = addCommas(Math.round(varSubTotal)) ;

    }



    function addCommas(nStr){
      nStr += '';
      x = nStr.split(',');
      x1 = x[0];
      x2 = x.length > 1 ? ',' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
    function addCommas2(nStr){
      nStr += '';
      x = nStr.split(',');
      x1 = x[0];
      x2 = x.length > 1 ? ',' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }



    //evento para manejar los datos segun el tipo (aerea o subterranea)
    $(document).on('change','#tipo',function(){

      var  tipo = $(this).val();

      if (tipo == 'Aérea') {
        $(this).parent().parent().parent().find('#cajas').attr("readonly", true);
        $(this).parent().parent().parent().find('#cajas').val(0);
        $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);

      }
        else if (tipo == 'Subterránea') {
          $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
          $(this).parent().parent().parent().find('#apoyos').attr("readonly", true);
          $(this).parent().parent().parent().find('#apoyos').val(0);
        }
        else {
          $(this).parent().parent().parent().find('#cajas').attr("readonly", false);
          $(this).parent().parent().parent().find('#apoyos').attr("readonly", false);
        }


    });
    //evento para manejar los datos segun el tipo de distribucion
    $(document).on('change','#desc',function(){

      var  desc = $(this).val();

      if (desc == 'Inspección RETIE proceso de distribución en MT') {
        $(this).parent().parent().parent().find("#tension").html('');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,2">13,2</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,4">13,4</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="13,8">13,8</option>');
        $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');

      }
        else {
          $(this).parent().parent().parent().find("#tension").html('');
          $(this).parent().parent().parent().find("#tension").append('<option value="110-220">110-220</option>');
          $(this).parent().parent().parent().find("#tension").append('<option value="220-240">220-240</option>');
          $(this).parent().parent().parent().find("#tension").append('<option value="No aplica">No aplica</option>');
        }


    });

    //evento para manejar los datos segun el tipo de uso final
    $(document).on('change','#instalacion',function(){

      var  instalacion = $(this).val();

      if (instalacion == 'Inspección RETIE proceso uso final residencial') {
        $(this).parent().parent().parent().find("#tipo3").html('');
        $(this).parent().parent().parent().find("#tipo3").append('<option value="Casa">Casa</option>');
        $(this).parent().parent().parent().find("#tipo3").append('<option value="Apartamentos">Apartamentos</option>');
        $(this).parent().parent().parent().find("#tipo3").append('<option value="Zona común">Zona común</option>');

      }
        else if (instalacion == 'Inspección RETIE proceso uso final comercial') {
          $(this).parent().parent().parent().find("#tipo3").html('');
          $(this).parent().parent().parent().find("#tipo3").append('<option value="Local comercial">Local comercial</option>');
          $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
        }
        else {
          $(this).parent().parent().parent().find("#tipo3").html('');
          $(this).parent().parent().parent().find("#tipo3").append('<option value="Bodega">Bodega</option>');
        }

    });

      $(document).ready(function($){
        $('#codigo_proyecto').inputmask('CPS-9999-999');
      });
      // los sgtes eventos son los encargados de manejar matematicamente todos los calculos de impuestos operaciones y diferentes cosas que requiere
      // el modulo de administrativa
      $('.antesiva').on('keyup',function(){
          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().parent().parent().find('.otrosi').val(addCommas2(Math.round(resultado)));



      });
      $('.valor').keyup(function(){
          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));


      });

      $('.valor_factura').on('keyup',function(){

          var valor = $(this).val().replace(/,/g,"");
          var resultado = valor * 1.19;
          var iva = valor*0.19;
          $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
          $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));

          var retencionesporcen = $(this).parent().parent().parent().find('.retencionesporcen').val().replace(/,/g,".");
          var valor2 = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
          var resultado2 = valor2*retencionesporcen/100;
          $(this).parent().parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado2)));

          var retegarantiaporcen = $(this).parent().parent().parent().find('.retegarantiaporcen').val().replace(/,/g,".");
          var valor3 = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado3 = valor3*retegarantiaporcen/100;
          $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado3)));


          var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
          var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
          var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
          var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado4 =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
          $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado4)));


      });




      $('.retencionesporcen').keyup(function(){
        var retencionesporcen = parseFloat($(this).val().replace(/,/g,"."));
        var valor = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
        var resultado = valor*retencionesporcen/100;
        $(this).parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado)));
      });
      $('.retencionesporcen').change(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });

      $('.amortizacion').keyup(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
        });

      $('.polizas').keyup(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });
      $('.retegarantiaporcen').keyup(function(){
        var retegarantiaporcen = parseFloat($(this).val().replace(/,/g,"."));
        var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado = valor*retegarantiaporcen/100;
        $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado)));
      });
      $('.retegarantiaporcen').change(function(){
        var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
        var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
        var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
        var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
        var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
        var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
        $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
      });

      $('.retencionesporcen').focus(function(){
        var retenciones = parseInt($(this).val(""));
      });
      $('.amortizacion').focus(function(){
        var amortizacion = parseInt($(this).val(""));
      });
      $('.polizas').focus(function(){
        var polizas = parseInt($(this).val(""));
      });
      $('.retegarantiaporcen').focus(function(){
        var retegarantia = parseInt($(this).val(""));
      });


  </script>
@endsection
@section('contenido')

  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
    <li class="active">Editar Proyecto</li>
  </ol>

  <div class="box box-primary">
    <div class="box-header with-border">
      <center><h3 >Datos del proyecto</h3></center>
    </div>

    @if(Session::has('message'))
      <div class="" id="alert">
        <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
        <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{Session::get('message')}}
        </div>
      </div>
    @endif

    <div class="formulario_principal">
      {!! Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]) !!}
      {{ csrf_field() }}
        <div class="box-body">
          <div class="col-md-4">
            <div class="form-group">
              {!! Form::label('codigo_proyecto', 'Código del proyecto:') !!}
              {!! Form::text('codigo_proyecto', null, ['class' => 'form-control' , 'required' => 'required', 'pattern'=>'[A-Z]{3}[-]{1}[0-9]{4}[-]{1}[0-9]{3}']) !!}
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
              <div class="form-group">
                <label >Tipo de régimen</label>
                <select class="form-control" name="tipo_regimen" id="cliente" required="">
                  <option value="1">Persona natural</option>
                  <option value="2">Persona jurídica</option>
                </select>
              </div>
              <div class="form-group" id="natural">
                <label >Persona natural</label>
                <select class="form-control select2" name="cliente_id" style="width: 100%;" id="select-natural">
                  <option value="{{ $administrativas->cliente->id }}">{{ $administrativas->cliente->nombre }}</option>
                  @foreach($clientes as $cliente)
                  <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" style="Display:none" id="juridica">
                <label>Persona jurídica</label>
                <select class="form-control" name="juridica_id" style="width: 100%;" >
                  <option value="">Seleccione</option>
                  @foreach($juridicas as $juridica)
                  <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
                  @endforeach
                </select>
              </div>
            @endif
            @if(empty($administrativas->cliente->id ))
              <div class="form-group">
                <label>Tipo Regimen</label>
                <select class="form-control" name="tipo_regimen" id="cliente" required="">
                  <option value="2">Persona jurídica</option>
                  <option value="1">Persona natural</option>
                </select>
              </div>
              <div class="form-group" style="Display:none" id="natural">
                <label >Persona natural</label>
                <select class="form-control select2" style="Display:none;width: 100%;" name="cliente_id" id="select-natural">
                  <option value="">Seleccione</option>
                  @foreach($clientes as $cliente)
                  <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group"  id="juridica">
                <label >Persona jurídica</label>
                <select class="form-control" name="juridica_id" style="width: 100%;" >
                  <option value="{{ $administrativas->juridica->id }}">{{ $administrativas->juridica->razon_social }}</option>
                  @foreach($juridicas as $juridica)
                  <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
                  @endforeach
                </select>
              </div>
            @endif
            <div class="form-group">
              <label >Departamento</label>
              <select class="form-control" required="" name="departamento_id" id="departamento">
                <option value="{{ $administrativas->departamento->id }}">{{ $administrativas->departamento->nombre }}</option>
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label >Municipios</label>
              <select class="form-control" data-placeholder="Seleccione" multiple="multiple" name="municipio[]" style="width:100%" id="municipio" required="">

                 @for ($i = 0; $i <  count($array_muni); $i++)
                    <?php $municipios= $array_muni[$i];?>
                   @foreach($municipios as $muni)
                     <option value="{{ $muni->id}}" selected>{{ $muni->nombre}}</option>
                   @endforeach
                 @endfor
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label >Tipo de zona</label>
              <select class="form-control" required="" name="zona">
                <option value="{{ $administrativas->tipo_zona }}">{{ $administrativas->tipo_zona }}</option>
                <option value="Urbana">Urbana</option>
                <option value="Rural">Rural</option>
                <option value="Urbana/Rural">Urbana/Rural</option>
              </select>
            </div>
            <div class="form-group">
              <label >Valor contrato final</label>
              <input type="text" class="form-control" min="0" id="fin" autocomplete="off" onkeyup="calcular(); mascara(this,cpf)"  onkeyup="mascara(this,cpf)"  onpaste="return false" required="ingrese así sea un cero" placeholder= "Valor final" name="contrato_final" value="{{ number_format($administrativas->valor_contrato_final,0)}}">
            </div>
            <div class="form-group">
              <label >Valor IVA</label>
              <input type="text" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor IVA" name="iva" value="{{ number_format($administrativas->valor_iva,0) }}">
            </div>
            <div class="form-group">
              {!! Form::label('valor_contrato_inicial', 'Valor antes de IVA') !!}
              {!! Form::text('valor_contrato_inicial',  $administrativas->valor_contrato_inicial , ['class' => 'form-control' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
            </div>
            <div class="form-group">
              <label >Plan de pago</label>
              <select name="formas_pago" style="width:100%" required>
                <option value="{{ $administrativas->formas_pago }}">{{ $administrativas->formas_pago }}</option>
                <option value="Anticipo 100%">Anticipo 100%</option>
                <option value="Anticipo 50% - 50% a la entrega de dictámenes">Anticipo 50% - 50% a la entrega de dictámenes</option>
                <option value="Anticipo 50% - 50% en Actas parciales según avance de Obra">Anticipo 50% - 50% en Actas parciales según avance de Obra</option>
                <option value="Anticipo del 30% - 70% en Actas parciales según avance de Obra">Anticipo del 30% - 70% en Actas parciales según avance de Obra</option>
                <option value="Anticipo 30% - 70% a la entrega de dictámenes">Anticipo 30% - 70% a la entrega de dictámenes</option>
              </select>
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
                <center><a href="{{ route('adicionales.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal2" style="background-color: #33579A; border-color:#33579A;">Valor adicional</a></center>
              </div>
            @endif
            @if(count($otrosis) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Otro sí</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal3" style="background-color: #33579A; border-color:#33579A;">Otro sí</a></center>
              </div>
            @endif
            @if(count($pu_finales) == 0)
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled>Proceso uso final</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('pu_final.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal4" style="background-color: #33579A; border-color:#33579A;">Proceso uso final</a></center>
              </div>
            @endif
            @if(count($distribuciones) == 0 )
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Alcance distribución</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('distribuciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal5" style="background-color: #33579A; border-color:#33579A;">Alcance distribución</a></center>
              </div>
            @endif
            @if(count($transformaciones) == 0)
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled >Alcance transformación</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal6" style="background-color: #33579A; border-color:#33579A;" >Alcance transformación</a></center>
              </div>
            @endif
            @if(count($facturas) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Facturas</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal7" style="background-color: #33579A; border-color:#33579A;">Facturas</a></center>
              </div>
            @endif
            @if(count($cuenta_cobros) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Cuentas de cobro</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('cuenta_cobros.edit', $administrativas->id) }}" class="btn btn-primary botoncito " data-toggle="modal" data-target="#myModal8"style="background-color: #33579A; border-color:#33579A;">Cuentas de cobro</a></center>
              </div>
            @endif
            @if(count($consignaciones) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Consignaciones</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal9" style="background-color: #33579A; border-color:#33579A;">Consignaciones</a></center>
              </div>
            @endif
            <div class="col-md-12 div2">
              <center><a href="#myModal10" class="btn btn-primary botoncito" data-toggle="modal" data-target="" style="background-color: #33579A; border-color:#33579A;">Crear observación</a></center>
            </div>
          </div>
          <div class="col-md-12">

            <div class="col-md-12">
              <div class="col-md-1">
                <div class="form-group">
                  <label>#</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Observaciones</label>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Fecha</label>
                </div>
              </div>
            </div>
            @foreach($observaciones as $key => $obs)
              <div class="col-md-12">
                <div class="col-md-1">
                  <div class="form-group">
                    <td>{{ $key+1 }}</td>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <td>{{ $obs->observacion }}</td>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <td>{{ date_format(new DateTime($obs->created_at), 'd-m-y') }}</td>
                  </div>
                </div>
              </div>
            @endforeach


          </div>

        </div>
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>


      {!! Form::close() !!}

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal10"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              {!! Form::open(['class'=>'form2','url' => 'observaciones']) !!}
              {{ csrf_field() }}
                <div class="box-body">

                  <br>
                  <div class="col-md-2">
                    <div class="form-group">
                      {!! Form::label('observacion', 'Observación') !!}
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <td><textarea  rows="4" cols="60" name="observacion" required=""></textarea></td>
                    </div>
                  </div>
                  <input type="hidden" name="administrativa_id" value="{{$administrativas->id}}">
                  <div class="box-footer">
                    <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Crear</button>
                  </div>
                </div>


              {!! Form::close() !!}
            </div>
          </div>
        </div>
      <!-- fin modal -->

      <div class="modal fade bs-example-modal-lg" id="myModal7"  role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg3" role="document">
          <div class="modal-content">

            <div class="box box-primary">
              <div class="box-header with-border">
                <center> <h3 class="box-title"> Editar factura</h3> </center>
              </div>
              <div class="box-body">
                <div class="col-md-12 well">
                    <table id="example" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Número factura</th>
                          <th>Fecha de la factura</th>
                          <th>Valor antes de IVA</th>
                          <th>IVA</th>
                          <th>Valor con IVA</th>
                          <th>Acciones</th>
                          <th>Alertas</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($facturas as $key => $factura)
                        <tr>
                          <td>{{$factura->num_factura}}</td>
                          <td>{{ date_format(new DateTime($factura->fecha_factura), 'd-m-y') }}</td>
                          <td>${{ number_format($factura->valor_factura,0) }}</td>
                          <td>${{ number_format($factura->iva,0) }}</td>
                          <td>${{ number_format($factura->valor_total,0) }}</td>
                          <td>
                            <a href="" data-toggle="modal" data-target="#myModal20-{{ $key }}"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                            <a href="{{ url('deletefactura') }}/{{ $factura->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                            <!-- inicio modal 1 -->

                            <div class="modal fade" id="myModal20-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog">
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
                          </td>
                          <td>
                            @if($factura->recuerdame == 1)
                            <a title="Esta es la factura pendiente">
                              <i class="glyphicon glyphicon-alert" style="color: #ff2f00"></i>
                            </a>
                            @else

                            @endif

                          </td>

                        </tr>
                          @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal2" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal3"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg3" role="document">
            <div class="modal-content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <center> <h3 class="box-title"> Editar otro si</h3> </center>
                </div>
                <div class="box-body">
                  <div class="col-md-12 well">

                      <table id="example" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Valor antes de IVA</th>
                            <th>IVA</th>
                            <th>Valor con IVA</th>
                            <th>Detalles</th>
                            <th>Acciones</th>
                            <th>Alertas</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($otrosis as $key => $otro)
                          <tr>
                            <td>${{ number_format($otro->valor,0) }}</td>
                            <td>${{ number_format($otro->iva,0) }}</td>
                            <td>${{ number_format($otro->valor_tot,0) }}</td>
                            <td>{{$otro->detalles}}</td>
                            <td>
                              <a href="{{ route('otrosi.edit', $otro->id) }}" data-toggle="modal" data-target="#myModal21-{{ $key }}"><i class="glyphicon glyphicon-pencil" style="color: #33579A"></i></a>
                              <a href="{{ url('deleteotrosi') }}/{{ $otro->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign" style="color: #33579A"></i></a>
                              <!-- inicio modal 1 -->

                              <div class="modal fade" id="myModal21-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">

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
                              <!-- fin modal -->
                            </td>
                            <td>
                              @if($otro->recuerdame == 1)
                              <a title="Esta es la factura pendiente">
                                <i class="glyphicon glyphicon-alert" style="color: #f39c12"></i>
                              </a>
                              @else

                              @endif
                            </td>

                          </tr>
                            @endforeach
                      </tbody>
                    </table>

                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      <!-- fin modal -->

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal4"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal5"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal6"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg2" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->

      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal8"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              @include('cuenta_cobros.edit')
            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal9"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              @include('consignaciones.edit')
            </div>
          </div>
        </div>
      <!-- fin modal -->

    </div>
  </div>

@endsection
