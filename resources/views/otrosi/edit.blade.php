<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3> Editar otro sí</h3> </center>
  </div>
  <div class="box-body">


        {!! Form::model($otro, ['method' => 'PATCH', 'action' => ['OtrosiController@update',$otro->id],'autocomplete'=>"off"]) !!}
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $otro->id}}">


        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <center><label >Otro sí antes IVA</label></center>
            </div>
            <div class="form-group ">
              <div class="col-md-4">
                <input type="text" class="form-control antesiva" id="antesiva"    onkeypress="mascara(this,cpf)"  onpaste="return false" placeholder= "Ingrese valor" name="valor"   value="{{ number_format($otro->valor,0) }}">
              </div>
              <div class="col-md-4" >

              </div>
            </div>
          </div>
        </div>

          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">
                <center><label >IVA</label></center>
              </div>
              <div class="form-group ">
                <div class="col-md-4">
                  <input type="text" class="form-control iva" id="iva2" readonly placeholder= "valor" name="iva" value="{{ number_format($otro->iva,0) }}" >
                </div>
                <div class="col-md-4" >

                </div>
              </div>
            </div>
          </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">
                  <center><label >Valor total otro sí</label></center>
                </div>
                <div class="form-group ">
                  <div class="col-md-4">
                    <input type="text" class="form-control otrosi" id="otrosi" readonly  placeholder= "valor" name="valor_tot" value="{{ number_format($otro->valor_tot,0) }}">
                  </div>
                  <div class="col-md-4" >
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-4">
                  <center><label >Detalles</label></center>
                </div>
                <div class="form-group ">
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="detalles"   placeholder= "Ingrese detalle" name="detalles" value="{{$otro->detalles}}" >
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

                    <div class="col-md-6">
                      <label class="radio-inline">
                        <input type="radio" name="recordarme" value="1" required > Si
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="recordarme" value="0"> No
                      </label>
                    </div>
                    <div class="col-md-2" id="tblprod7">
                    </div>

                  <div class="box-footer">
                    <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
                  </div>
              </div>

            </div>
        {!! Form::close() !!}

      </div>
    </div>

    <!-- <script>
      $(document).ready(function() {


      // Interceptamos el evento submit
      $('.form1').on('submit',function() {
    // Enviamos el formulario usando AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
              // Mostramos un mensaje con la respuesta de PHP
                success: function() {
                  alert('Alcance de distribucion editado');
                  $('.modal').modal('hide');
                }
            })
            return false;
        });
      });


    </script> -->
