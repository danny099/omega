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

      varMonto = document.getElementById("valor_contrato_inicial").value;
      varMonto = varMonto.replace(/[\,]/g,'');

      varIva = parseFloat(varMonto) * 0.19;
      document.getElementById("iva").value = addCommas(parseFloat(varIva)) ;

      varSubTotal = parseFloat(varMonto) + parseFloat(varIva);
      document.getElementById("fin").value = addCommas(parseFloat(varSubTotal)) ;

    }
    function calcular2(){
      var varMonto;
      var varIva;
      var varSubTotal;

      varMonto = document.getElementById("antesiva").value;
      varMonto = varMonto.replace(/[\,]/g,'');

      varIva = parseFloat(varMonto) * 0.19;
      document.getElementById("iva2").value = addCommas(parseFloat(varIva)) ;

      varSubTotal = parseFloat(varMonto) + parseFloat(varIva);
      document.getElementById("otrosi").value = addCommas(parseFloat(varSubTotal)) ;

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
  </script>
  <script type="text/javascript">

    $(function() {
      $('table').DataTable({
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

   $(function() {

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



             $('.valor_factura').keyup(function(){
                 var valor = $(this).val().replace(/,/g,"");
                 var resultado = valor * 1.19;
                 var iva = valor*0.19;
                 $(this).parent().parent().parent().find('.iva').val(addCommas2(parseFloat(iva)));
                 $(this).parent().parent().parent().find('.valor_total').val(addCommas2(parseFloat(resultado)));

                 var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
                 var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
                 var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
                 var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
                 var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
                 var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
                 $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));


             });
             $('.retencionesporcen').keyup(function(){
               var retencionesporcen = parseInt($(this).val());
               var valor = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
               var resultado = valor*retencionesporcen/100;
               $(this).parent().parent().find('.retenciones').val(addCommas2(parseFloat(resultado)));
             });
             $('.retencionesporcen').change(function(){
               var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
               var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
               var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
               var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
               var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
               $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
             });
             $('.amortizacionporcen').keyup(function(){
               var amortizacionporcen = parseInt($(this).val());
               var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado = valor*amortizacionporcen/100;
               $(this).parent().parent().parent().find('.amortizacion').val(addCommas2(parseFloat(resultado)));
             });
             $('.amortizacionporcen').change(function(){
               var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
               var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
               var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
               var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
               var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
               $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
               });
             $('.polizasporcen').keyup(function(){
               var polizasporcen = parseInt($(this).val());
               var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado = valor*polizasporcen/100;
               $(this).parent().parent().parent().find('.polizas').val(addCommas2(parseFloat(resultado)));
             });
             $('.polizasporcen').change(function(){
               var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
               var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
               var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
               var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
               var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
               $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
             });
             $('.retegarantiaporcen').keyup(function(){
               var retegarantiaporcen = parseInt($(this).val());
               var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado = valor*retegarantiaporcen/100;
               $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(parseFloat(resultado)));
             });
             $('.retegarantiaporcen').change(function(){
               var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
               var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
               var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
               var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
               var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
               var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
               $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
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
      <center><h3 class="box-title">Datos del proyecto</h3></center>
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
              <div class="form-group">
                <label >Tipo cliente</label>
                <select class="form-control" name="cliente_id" id="cliente" required="">
                  <option value="1">Persona natural</option>
                  <option value="2">Persona juridica</option>
                </select>
              </div>
              <div class="form-group" id="natural">
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
              <div class="form-group">
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
              {!! Form::text('valor_contrato_inicial',  $administrativas->valor_contrato_inicial , ['class' => 'form-control' , 'required' => 'required', 'onkeypress'=>'mascara(this,cpf)', 'onkeyup'=>'calcular()', 'min'=>'0']) !!}
            </div>
            <div class="form-group">
              <label >Valor iva</label>
              <input type="text" min="0" class="form-control" id="iva" readonly="readonly" placeholder= "valor iva" name="iva" value="{{ number_format($administrativas->valor_iva,0) }}">
            </div>
            <div class="form-group">
              <label >Valor contrato final</label>
              <input type="text" class="form-control" min="0" id="fin" readonly="readonly" placeholder= "Valor final" name="contrato_final" value="{{ number_format($administrativas->valor_contrato_final,0) }}">
            </div>
            <div class="form-group">
              <label >Plan de pago</label>
              <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago" value="{{ $administrativas->plan_pago}}">
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
                <center><a href="{{ route('adicionales.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal2">Valor adicional</a></center>
              </div>
            @endif
            @if(count($otrosis) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Otro si</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('otrosi.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal3">Otro si</a></center>
              </div>
            @endif
            @if(count($pu_finales) == 0)
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled>Proceso uso final</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('pu_final.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal4">Proceso uso final</a></center>
              </div>
            @endif
            @if(count($distribuciones) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Alcance distribucion</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('distribuciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal5">Alcance distribucion</a></center>
              </div>
            @endif
            @if(count($transformaciones) == 0)
              <div class="col-md-12 div2">
                <center><a  class="btn btn-primary botoncito" disabled >Alcance transformacion</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary botoncito"data-toggle="modal" data-target="#myModal6" >Alcance transformacion</a></center>
              </div>
            @endif
            @if(count($facturas) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Facturas</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('facturas.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal7">Facturas</a></center>
              </div>
            @endif
            @if(count($cuenta_cobros) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Cuentas de cobro</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="{{ route('cuenta_cobros.edit', $administrativas->id) }}" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal8">Cuentas de cobro</a></center>
              </div>
            @endif
            @if(count($consignaciones) == 0)
              <div class="col-md-12 div2">
                <center><a class="btn btn-primary botoncito" disabled>Consignaciones</a></center>
              </div>
            @else
              <div class="col-md-12 div2">
                <center><a href="" class="btn btn-primary botoncito" data-toggle="modal" data-target="#myModal9">Consignaciones</a></center>
              </div>
            @endif
            <div class="col-md-12 div2">
              <center><a href="#myModal10" class="btn btn-primary botoncito" data-toggle="modal" data-target="">Crear observacion</a></center>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-12">
              <div class="col-md-1">
                <div class="form-group">
                  <label>#</label>
                </div>
              </div>
              <div class="col-md-11">
                <div class="form-group">
                  <label>Observaciones</label>
                </div>
              </div>
            </div>
            <table>
              @foreach($observaciones as $key => $obs)
                <div class="col-md-12">
                  <div class="col-md-1">
                    <div class="form-group">
                      <td>{{ $key+1 }}</td>
                    </div>
                  </div>
                  <div class="col-md-11">
                    <div class="form-group">
                      <td><textarea  rows="4" cols="110" name="resumen"  value="{{ $obs->observacion }}" readonly="">{{ $obs->observacion }}</textarea></td>
                    </div>
                  </div>
                </div>
              @endforeach
            </table>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
        </div>


      {!! Form::close() !!}

      <div class="modal fade bs-example-modal-lg" id="myModal7"  role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            @include('facturas.index')
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              @include('otrosi.index')
            </div>
          </div>
        </div>
      <!-- fin modal -->

      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal4"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal5"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
          </div>
        </div>
      <!-- fin modal -->
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal6"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
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
      <!-- inicio modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal10"  role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              {!! Form::open(['class'=>'form2','url' => 'observaciones']) !!}
              {{ csrf_field() }}
                <div class="box-body">
                  <div class="col-md-2">
                    <div class="form-group">
                      {!! Form::label('observacion', 'Observacion') !!}
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
    </div>
  </div>

@endsection
