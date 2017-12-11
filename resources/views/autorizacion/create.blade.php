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
            <div class="col-md-8">

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Jhon Jairo Escobar Segura</p></center>
                  <input type="hidden" name="nombre_jefe" value="Jhon Jairo Escobar Segura">
                  <center><label>Jefe de poyectos</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  name="obs_jefe"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Jairo Ivan Ibarra Ruales</p></center>
                  <input type="hidden" name="nombre_director" value="Jairo Ivan Ibarra Ruales">
                  <center><label>Director tecnico</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Observaciones:</label></center>
                  <textarea class="form-control" rows="3"  name="obs_director"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <center><p> Autorizado por:</p></center>
                  <center><p>Alejandra Vitali</p></center>
                  <input type="hidden" name="nombre_administrativa" value="Alejandra Vitali">
                  <center><label>Gerente administrativa</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
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
                  <input type="hidden" name="nombre_general" value="Juan Manuel Leon S.">
                  <center><label>Gerente general</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
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
                  <input type="hidden" name="nombre_presidente" value="Oscar Andres Sanclemente R.">
                  <center><label>Presidente</label><br></center>
                  <center><label>Fecha de autorizacion</label></center>
                </div>
                <div class="col-md-4">
                  <center><label>Firma:</label></center>
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
                  <input type="text" name="Transformacion" value="">
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
                    <input type="text" name="Casas" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Apartamentos")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Apartamentos</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="Apartamentos" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Zona común")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Zonas comunes</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="Zonas" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Local comercial")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Locales comerciales</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="Locales" value="">
                  </div>
                </div>
                @endif

                @if($pu->tipo == "Bodega")
                <div class="col-md-12">
                  <div class="col-md-6">
                    <label>Bodegas</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="Bodegas" value="">
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


@endsection