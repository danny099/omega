@extends('index')

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

    varMonto = document.getElementById("antesiva").value;
    varMonto = varMonto.replace(/[\,]/g,'');

    varIva = parseFloat(varMonto) * 0.19;
    document.getElementById("iva").value = addCommas(parseFloat(varIva)) ;

    varSubTotal = parseFloat(varMonto) + parseFloat(varIva);
    document.getElementById("otrosi").value = addCommas(parseFloat(varSubTotal)) ;

  }


  function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
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


        $('.valor_factura').keyup(function(){
            var valor = $(this).val().replace(/,/g,"");
            var resultado = valor * 1.19;
            var iva = valor*0.19;
            $(this).parent().parent().parent().find('.iva').val(addCommas2(parseFloat(iva)));
            $(this).parent().parent().parent().find('.valor_total').val(addCommas2(parseFloat(resultado)));


        });
        $('.retencionesporcen').keyup(function(){
          var retencionesporcen = parseInt($(this).val());
          var valor = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
          var resultado = valor*retencionesporcen/100;
          $(this).parent().parent().find('.retenciones').val(resultado);
        });
        $('.retencionesporcen').change(function(){
          var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
          var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
          var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
          var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
          $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
        });
        $('.amortizacionporcen').keyup(function(){
          var amortizacionporcen = parseInt($(this).val());
          var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado = valor*amortizacionporcen/100;
          $(this).parent().parent().parent().find('.amortizacion').val(resultado);
        });
        $('.amortizacionporcen').change(function(){
          var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
          var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
          var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
          var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
          $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
        });
        $('.polizasporcen').keyup(function(){
          var polizasporcen = parseInt($(this).val());
          var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado = valor*polizasporcen/100;
          $(this).parent().parent().parent().find('.polizas').val(resultado);
        });
        $('.polizasporcen').change(function(){
          var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
          var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
          var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
          var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
          $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(parseFloat(resultado)));
        });
        $('.retegarantiaporcen').keyup(function(){
          var retegarantiaporcen = parseInt($(this).val());
          var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado = valor*retegarantiaporcen/100;
          $(this).parent().parent().parent().find('.retegarantia').val(resultado);
        });
        $('.retegarantiaporcen').change(function(){
          var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
          var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
          var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
          var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
          var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
          var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
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

  </script>
@endsection

@section('contenido')
    <ol class="breadcrumb">
      <li><a href="{{ url('index') }}">Inicio</a></li>
      <li class="active">Administrativa</li>
    </ol>
    @if(Session::has('message'))
    <div id="alert">
      <div class="col-sm-12 hr hr-18 hr-double dotted"></div>
      <div class="col-sm-4 col-xs-12 col-sm-offset-4 alert alert-{{Session::get('class')}}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{Session::get('message')}}
      </div>
    </div>
    @endif
    <div class="col-md-12 well">
      <a class="btn btn-primary" data-toggle="modal" href="{{ url('administrativas/create') }}"><i class="fa fa-user-plus"></i> Crear Contrato</a>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Codigo del proyecto</th>
              <th>Nombre del proyecto</th>
              <th>Fecha del contrato</th>
              <th>Valor final del contrato</th>
              <th>Acciones</th>
              <th>Recordatorios</th>
            </tr>
          </thead>
          <tbody>
            @foreach($administrativas as $key => $administrativa)
            <tr>
              <td>{{$administrativa->codigo_proyecto}}</td>
              <td>{{$administrativa->nombre_proyecto}}</td>
              <td>{{$administrativa->fecha_contrato}}</td>
              <td>{{number_format($administrativa->valor_contrato_final,0,",",".")}}</td>
              <td>
                <a href="{{ route('administrativas.edit', $administrativa->id) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="{{ route('administrativas.show', $administrativa->id) }}" data-toggle="model" data-target="show-{{ $key }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="#myModal-{{ $key }}" data-toggle="modal" data-target=""><i class="fa fa-money"></i></a>
                <a href="{{ url('deleteadminstrativa') }}/{{ $administrativa->id }}" onClick="javascript: return confirm('Esta seguro de eliminar registro?');"><i class="glyphicon glyphicon-minus-sign"></i></a>
                <!-- inicio modal 1 -->
                <div class="modal fade" id="myModal-{{ $key }}" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pagos</h4>
                      </div>
                      <div class="modal-body">
                        <center><h4> ¿Desea anexar un pago? </h4></center>
                        <br>
                        <center>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2-{{ $key }}" name="button">Consignacion</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3-{{ $key }}" name="button">Cuenta de Cobro</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4-{{ $key }}" name="button">Factura</button>
                        </center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal2-{{ $key }}" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('consignaciones.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal3-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('cuenta_cobros.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->

                <!-- inicio modal 2 -->
                <div class="modal fade" id="myModal4-{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        @include('facturas.create')
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin modal -->


              </td>

              @if($administrativa->recordar == 0)
              <td><a><i class="glyphicon glyphicon-alert" style="color:#ff9b00"></i></a></td>
              @else
              <td></td>
              @endif

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection
