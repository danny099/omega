@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('criterio/disDeta') }}">Autorización de dictámenes</a></li>
    <li class="active">Crear autorización de dictámenes</li>
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
          <form class="" action="{{ url('autorizacion') }}" method="post">
            {{csrf_field()}}
            <div class="col-md-8">
              <input type="hidden" name="administrativa_id" value="{{$contrato->id}}">
              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Jhon Jairo Escobar Segura</p></center>
                  <input type="hidden" name="nombre_jefe" class="jefe1" value="">
                  <center><label>Jefe de poyectos</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>

                  <center> <input type="button" class="btn btn-primary jefe" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                  <input type="hidden" name="firma_jefe" class="firma_jefe" value="">
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3" class="jefe" name="obs_jefe"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Jairo Ivan Ibarra Ruales</p></center>
                  <input type="hidden" name="nombre_director" class"director1" value="">
                  <center><label>Director tecnico</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                  <center><input type="button" class="btn btn-primary director" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                  <input type="hidden" name="firma_director" class="firma_director" value="">
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  class"director" name="obs_director"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Alejandra Vitali</p></center>
                  <input type="hidden" name="nombre_administrativa" class="administrativa1" value="">
                  <center><label>Gerente administrativa</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                  <center><input type="button" class="btn btn-primary administrativa" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                  <input type="hidden" name="firma_administrativa" class="administrativa" value="">
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  name="obs_administrativa"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Juan Manuel Leon S.</p></center>
                  <input type="hidden" name="nombre_general"  class="general1" value="">
                  <center><label>Gerente general</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                  <center><input type="button" class="btn btn-primary general" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                  <input type="hidden" name="firma_general" class="general" value="">
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  name="obs_general"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Oscar Andres Sanclemente R.</p></center>
                  <input type="hidden" name="nombre_presidente" class="presidente1" value="">
                  <center><label>Presidente</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                  <center><input type="button" class="btn btn-primary presidente" style="background-color: #33579A; border-color:#33579A;" value="Firma"></center>
                  <input type="hidden" name="firma_presidente" class="presidente" value="">
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  name="obs_presidente"></textarea>
                </div>
              </div>

            </div>
            <div class="col-md-4">
              <div class="col-md-12">
                <div class="col-md-6">
                  <center><label>Proceso</label></center>
                </div>
                <div class="col-md-6">
                  <center><label>Cant autorizada</label></center>
                </div>
              </div>
              
              @if($cantidad_t > 0)
              <div class="col-md-12">
                <div class="col-md-6">
                  <label>Transformacion</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="transformacion" value="">
                </div>
              </div>
              @endif

              @if($cantidad_dm > 0)
              <div class="col-md-12">
                <div class="col-md-6">
                  <label>Red MT (m)</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="red_mt" value="">
                </div>
              </div>
              @endif

              @if($cantidad_db > 0)
              <div class="col-md-12">
                <div class="col-md-6">
                  <label>Red BT (m)</label>
                </div>
                <div class="col-md-6">
                  <input type="text" name="red_bt" value="">
                </div>
              </div>
              @endif

              @foreach($pu_final as $pu)
                @if($pu->tipo == "Casa")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Casas</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="casas" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Apartamentos")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Apartamentos</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="apartamentos" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Zona común")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Zonas comunes</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="zonas" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Local comercial")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Locales comerciales</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="locales" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Bodega")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Bodegas</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="bodegas" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Punto fijo")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Puntos fijos</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="puntos_fijos" value="">
                  </div>
                </div>
                @endif
              @endforeach

              <div class="col-md-12">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
                </div>
              </div>

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
    $('.jefe1').val("Jhon Jairo Escobar Segura");
    $('.firma_jefe').val("firmas/FirmaJJES.png");
  });

  $(document).on("click",".director",function( event ) {
    $('.director1').val("Jairo Ivan Ibarra Ruales");
    $('.firma_director').val("firmas/FirmaJIIR.png");
  });

  $(document).on("click",".general",function( event ) {
    $('.firma_general').val("firmas/FirmaJMLS.png");
    $('.general1').val("Juan Manuel Leon S.");
  });

  $(document).on("click",".administrativa",function( event ) {
    $('.administrativa1').val("Alejandra Vitali");
    $('.firma_administrativa').val("firmas/FirmaAlejandra.png");
  });

  $(document).on("click",".presidente",function( event ) {
    $('.presidente1').val("Oscar Andres Sanclemente R.");
    $('.firma_presidente').val("firmas/FirmaOASR.png");
  });
</script>

@endsection
