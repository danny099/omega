<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title"> Editar valor adicional</h3> </center>
  </div>
  <div class="box-body">

        @foreach($otrosis as $key => $otro)
        {!! Form::model($otro, ['method' => 'PATCH', 'action' => ['OtrosiController@update',$otro->id]]) !!}
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $otro->id}}">


        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <center><label >otro si antes iva</label></center>
            </div>
            <div class="form-group ">
              <div class="col-md-4">
                <input type="number" class="form-control antesiva" id="antesiva" placeholder= "Ingrese valor" name="valor" value="{{$otro->valor}}"   >
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
                  <input type="number" class="form-control iva" id="iva" readonly placeholder= "valor" name="iva" value="{{$otro->iva}}" >
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
                    <input type="number" class="form-control otrosi" id="otrosi" readonly  placeholder= "valor" name="valor_tot" value="{{$otro->valor_tot}}">
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
        {!! Form::close() !!}
        @endforeach
        <div class="box-footer">
          <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Editar</button>
        </div>
      </div>
    </div>
