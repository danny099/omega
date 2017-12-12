@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('autorizacion') }}">Autorización de dictámenes</a></li>
    <li class="active">Editar autorización de dictámenes</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Crear autorización de dictámenes</h3>
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
        <div class="row">
          <form class="" action="{{ url('autorizacion/update') }}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="usuario" id="usuario" value="{{Auth::User()->id}}">
            <input type="hidden" name="usuario" id="rol" value="{{Auth::User()->rol_id}}">
            @foreach($autorizados as $key => $autorizada)
              <div class="col-md-8" >
                <input type="hidden" name="id_auto[]" value="{{$autorizada->id}}">
                <input type="hidden" name="administrativa_id" value="{{$autorizada->administrativa_id}}">

                <div class="col-md-12" id="contenedor{{$key}}">
                  <div class="col-md-4">
                    <center><p> Autorizado por:</p></center>
                    <center><p>{{ $nombres[$key] }}</p></center>
                    <input type="hidden" name="nombre[]" class="nombre{{$key}}" value="{{$autorizada->autorizado}}">
                    <center><label>{{ $cargos[$key] }}</label><br></center>
                    <center><label>Fecha de autorizacion</label></center>
                  </div>
                  <div class="col-md-4">
                    <center><label>Firma:</label></center>
                    <center> <input type="button" class="btn btn-primary {{$key}}" id="btnfirma{{$key}}" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                    <input type="hidden" name="firma[]" class="firma{{$key}}" value="">
                  </div>
                  <div class="col-md-4">
                    <center><label>Observaciones:</label></center>
                    <textarea class="form-control" rows="3" class="jefe{{$key}}" name="observaciones[]" id="observaciones{{$key}}" placeholder="">{{ $autorizada->observaciones}}</textarea>
                  </div>
                </div>
              </div>

            @endforeach

            <div class="col-md-4" style="margin-top: -696px; border: 1px solid; width: 30%">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <center><label>Proceso</label></center>
                  </div>
                  <div class="col-md-6">
                    <center><label>Cant autorizada</label></center>
                  </div>
                </div>
              <input type="hidden" name="id_cantidades" value="{{$cantidades->id}}">

              @if($cantidades->transformacion != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Transformacion</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="transformacion" value="{{$cantidades->transformacion}}">
                  </div>
                </div>
              @endif

              @if($cantidades->red_mt != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Red MT (m)</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="red_mt" value="{{$cantidades->red_mt}}">
                  </div>
                </div>
              @endif

              @if($cantidades->red_bt != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Red BT (m)</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="red_bt" value="{{$cantidades->red_bt}}">
                  </div>
                </div>
              @endif


              @if($cantidades->casas != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Casas</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="casas" value="{{$cantidades->casas}}">
                  </div>
                </div>
              @endif

              @if($cantidades->apartamentos != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Apartamentos</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="apartamentos" value="{{$cantidades->apartamentos}}">
                  </div>
                </div>
              @endif

              @if($cantidades->zonas != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Zonas comunes</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="zonas" value="{{$cantidades->zonas}}">
                  </div>
                </div>
              @endif

              @if($cantidades->locales != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Locales comerciales</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="locales" value="{{$cantidades->locales}}">
                  </div>
                </div>
              @endif

              @if($cantidades->bodegas != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Bodegas</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="bodegas" value="{{$cantidades->bodegas}}">
                  </div>
                </div>
              @endif

              @if($cantidades->puntos_fijos != null)
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Puntos fijos</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="puntos_fijos" value="{{$cantidades->puntos_fijos}}">
                  </div>
                </div>
              @endif
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
        
                <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A; margin:10px;">Enviar</button>
          

              </div>
          </form>
        </div>
        </div>
        <!-- /.box-body -->
        <br>

      {!! Form::close() !!}
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).on("click",".jefe",function( event ) {
    // $('.jefe1').val("Jhon Jairo Escobar Segura");
    $('.0').val("firmas/Certicol.png");
  });

  $(document).on("click",".director",function( event ) {
    // $('.director1').val("Jairo Ivan Ibarra Ruales");
    $('.1').val("firmas/Certicol.png");
  });

  $(document).on("click",".general",function( event ) {
    // $('.firma_general').val("firmas/Certicol.png");
    $('.2').val("Juan Manuel Leon S.");
  });

  $(document).on("click",".administrativa",function( event ) {
    // $('.administrativa1').val("Alejandra Vitali");
    $('.3').val("firmas/Certicol.png");
  });

  $(document).on("click",".presidente",function( event ) {
    // $('.presidente1').val("Oscar Andres Sanclemente R.");
    $('.4').val("firmas/Certicol.png");
  });


  $(document).ready(function(){
    var rol = $('#rol').val();
    // if (rol == 1 ) {
    //   $('#contenedor0').addClass('well');
    //   $("#observaciones0").attr('readonly','readonly');
    //   $("#btnfirma0").attr('disabled','disabled');
    // }
    if (rol == 3 ) {
      $('#contenedor0').addClass('well');
      $("#observaciones0").attr('readonly','readonly');
      $("#btnfirma0").attr('disabled','disabled');

      $('#contenedor1').addClass('well');
      $("#observaciones1").attr('readonly','readonly');
      $("#btnfirma1").attr('disabled','disabled');

      $('#contenedor2').addClass('well');
      $("#observaciones2").attr('readonly','readonly');
      $("#btnfirma2").attr('disabled','disabled');

      $('#contenedor4').addClass('well');
      $("#observaciones4").attr('readonly','readonly');
      $("#btnfirma4").attr('disabled','disabled');
    }

    if (rol == 4 ) {
      $('#contenedor0').addClass('well');
      $("#observaciones0").attr('readonly','readonly');
      $("#btnfirma0").attr('disabled','disabled');

      $('#contenedor1').addClass('well');
      $("#observaciones1").attr('readonly','readonly');
      $("#btnfirma1").attr('disabled','disabled');

      $('#contenedor3').addClass('well');
      $("#observaciones3").attr('readonly','readonly');
      $("#btnfirma3").attr('disabled','disabled');

      $('#contenedor4').addClass('well');
      $("#observaciones4").attr('readonly','readonly');
      $("#btnfirma4").attr('disabled','disabled');
    }

    if (rol == 5 ) {
      $('#contenedor1').addClass('well');
      $("#observaciones1").attr('readonly','readonly');
      $("#btnfirma1").attr('disabled','disabled');

      $('#contenedor2').addClass('well');
      $("#observaciones2").attr('readonly','readonly');
      $("#btnfirma2").attr('disabled','disabled');

      $('#contenedor3').addClass('well');
      $("#observaciones3").attr('readonly','readonly');
      $("#btnfirma3").attr('disabled','disabled');

      $('#contenedor4').addClass('well');
      $("#observaciones4").attr('readonly','readonly');
      $("#btnfirma4").attr('disabled','disabled');
    }

    if (rol == 6 ) {
      $('#contenedor0').addClass('well');
      $("#observaciones0").attr('readonly','readonly');
      $("#btnfirma0").attr('disabled','disabled');

      $('#contenedor2').addClass('well');
      $("#observaciones2").attr('readonly','readonly');
      $("#btnfirma2").attr('disabled','disabled');

      $('#contenedor3').addClass('well');
      $("#observaciones3").attr('readonly','readonly');
      $("#btnfirma3").attr('disabled','disabled');

      $('#contenedor4').addClass('well');
      $("#observaciones4").attr('readonly','readonly');
      $("#btnfirma4").attr('disabled','disabled');
    }

    if (rol == 7 ) {
      $('#contenedor0').addClass('well');
      $("#observaciones0").attr('readonly','readonly');
      $("#btnfirma0").attr('disabled','disabled');

      $('#contenedor1').addClass('well');
      $("#observaciones1").attr('readonly','readonly');
      $("#btnfirma1").attr('disabled','disabled');

      $('#contenedor2').addClass('well');
      $("#observaciones2").attr('readonly','readonly');
      $("#btnfirma2").attr('disabled','disabled');

      $('#contenedor3').addClass('well');
      $("#observaciones3").attr('readonly','readonly');
      $("#btnfirma3").attr('disabled','disabled');
    }
    
  });


</script>

@endsection
