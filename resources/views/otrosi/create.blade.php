@extends('index')

@section('scripts')
  <script type="text/javascript">

    $(function() {


      $('.antesiva').keyup(function(){
          var valor = parseInt($(this).val());
          var resultado = valor * 1.19;
          var iva = valor*0.19;

          $('.iva').val(iva);
          $('.otrosi').val(resultado);
      });
    });
  </script>
@endsection


@section('contenido')

  <form class="" action="{{ url('otrosi') }}" method="post">
    {{ csrf_field() }}
    <div class="container">
      <div class="box box-primary">
        <div class="box-header with-borde">
          <center> <h2 class="box-title">Agregar Otro si</h2> </center>
        </div>
        <div class="">
          <div class="box-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <center><label >Codigo Proyecto</label></center>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="col-md-4">
                      <select class="form-control select2" name="administrativa_id" style="width: 100%" id="select" required="">
                        <option value="">Seleccione..</option>
                        @foreach($codigos as $codigo)
                        <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <center><label >Valor otro si antes de iva</label></center>
                  </div>
                  <div class="form-group ">
                    <div class="col-md-4">
                      <input type="number" class="form-control antesiva" id="antesiva" placeholder= "Ingrese valor" name="valor"   >
                    </div>
                    <div class="col-md-4" >

                    </div>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      <center><label >Iva</label></center>
                    </div>
                    <div class="form-group ">
                      <div class="col-md-4">
                        <input type="number" class="form-control iva" id="iva" readonly placeholder= "valor" name="iva"  >
                      </div>
                      <div class="col-md-4" >

                      </div>
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <center><label >Valor total otro si</label></center>
                      </div>
                      <div class="form-group ">
                        <div class="col-md-4">
                          <input type="number" class="form-control otrosi" id="otrosi" readonly  placeholder= "valor" name="valor_tot">
                        </div>
                        <div class="col-md-4" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <center><label >detalles</label></center>
                      </div>
                      <div class="form-group ">
                        <div class="col-md-4">
                          <input type="text" class="form-control" id="detalles"   placeholder= "Ingrese detalle" name="detalles" >
                        </div>
                        <div class="col-md-4" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <center><label>Recordarme</label></center>
                      </div>
                      <div class="form-group ">
                        <div class="col-md-4">
                          <input type="radio" name="recordarme" value="0" checked> Si<br>
                          <input type="radio" name="recordarme" value="1"> No<br>
                        </div>
                        <div class="col-md-4" id="tblprod7">
                        </div>
                      </div>
                    </div>
                  </div>
              <button type="submit" class="btn btn-primary pull-right">
                Guardar
              </button>
            </div>
          </div>
        </div>
    </div>
  </form>
@endsection
