@extends('index')

@section('scripts')
  <script type="text/javascript">

    $(function() {
      $('table').DataTable();

      $('.valor_factura').keyup(function(){
          var valor = parseInt($(this).val());
          var resultado = valor * 1.19;
          var iva = valor*0.19;

          $(this).parent().parent().find('.iva').val(iva);
          $(this).parent().parent().find('.valor_total').val(resultado);
      });

      $('.retencionesporcen').keyup(function(){
        var retencionesporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().find('.valor_factura').val());
        var resultado = valor*retencionesporcen/100;
        $(this).parent().parent().find('.retenciones').val(resultado);
      });

      $('.retencionesporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.amortizacionporcen').keyup(function(){
        var amortizacionporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado = valor*amortizacionporcen/100;
        $(this).parent().parent().find('.amortizacion').val(resultado);
      });

      $('.amortizacionporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.polizasporcen').keyup(function(){
        var polizasporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado = valor*polizasporcen/100;
        $(this).parent().parent().find('.polizas').val(resultado);
      });

      $('.polizasporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().find('.valor_pagado').val(resultado);
      });

      $('.retegarantiaporcen').keyup(function(){
        var retegarantiaporcen = parseInt($(this).val());
        var valor = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado = valor*retegarantiaporcen/100;
        $(this).parent().parent().find('.retegarantia').val(resultado);
      });

      $('.retegarantiaporcen').change(function(){
        var retenciones = parseInt($(this).parent().parent().find('.retenciones').val());
        var amortizacion = parseInt($(this).parent().parent().find('.amortizacion').val());
        var polizas = parseInt($(this).parent().parent().find('.polizas').val());
        var retegarantia = parseInt($(this).parent().parent().find('.retegarantia').val());
        var valor_total = parseInt($(this).parent().parent().find('.valor_total').val());
        var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
        $(this).parent().parent().find('.valor_pagado').val(resultado);
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
            </tr>
          </thead>
          <tbody>
            @foreach($administrativas as $key => $administrativa)
            <tr>
              <td>{{$administrativa->codigo_proyecto}}</td>
              <td>{{$administrativa->nombre_proyecto}}</td>
              <td>{{$administrativa->fecha_contrato}}</td>
              <td>{{$administrativa->valor_contrato_final}}</td>
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
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection
