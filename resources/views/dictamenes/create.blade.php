@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('') }}">Dictamenes</a></li>
    <li class="active">Crear dictamenes</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Crear dictamenes</h3>
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
          <form class="" action="{{ url('dictamenes') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-12">
                  <input type="hidden" name="codigo" value="{{$contrato->id}}">
                  <div class="col-md-2 form-group">
                    <center><label>Inspector</label></center>
                    <select class="form-control inspector" id="inspector"name="dictamenes[inspector][]">
                      @foreach($inspectores as $inspector)
                      <option value="{{$inspector->id}}">{{$inspector->nombres}} {{$inspector->apellidos}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Matricula profesional</label></center>
                    <center><input type="text" name="dictamenes[matricula][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Director tecnico</label></center>
                    <select class="form-control" name="dictamenes[director][]">
                      @foreach($inspectores as $inspector)
                        @if($inspector->rol_inspector == "Director tecnico")
                        <option value="{{$inspector->nombres}} {{$inspector->apellidos}}">{{$inspector->nombres}} {{$inspector->apellidos}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Matricula profesional</label></center>
                    <center><input type="text" name="dictamenes[matricula_dir][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Codigo Dictamen(es)</label></center>
                    <center><input type="text" name="dictamenes[codigo][]" value="{{$contrato->codigo_proyecto}}"></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd" style="background-color: #fdea08; border-color:#fdea08; margin-top: 34px;"><i class="glyphicon glyphicon-plus"></i></a></center>

                  </div>

                </div>
                <div class="col-md-12 " id="dic">
                  <div class="col-md-2 form-group">
                    <center><label>Proceso dictaminado</label></center>
                    <select class="form-control" name="dictamenes[proceso][]">
                      <option value=""></option>
                      @if($cantidad_t > 0)
                        <option value="Transformacion">Transformacion</option>
                      @endif
                      @if($cantidad_dm > 0))
                        <option value="Red MT (m)">Red MT (m)</option>
                      @endif
                      @if($cantidad_db > 0))
                        <option value="Red BT (m)">Red BT (m)</option>
                      @endif
                      @foreach($pu_final as $pu)
                        @if($pu->tipo == "Casa")
                          <option value="Casas">Casas</option>
                        @endif

                        @if($pu->tipo == "Apartamentos")
                          <option value="Apartamentos">Apartamentos</option>
                        @endif
                        @if($pu->tipo == "Zonas")
                          <option value="Zonas comunes">Zonas comunes</option>
                        @endif

                        @if($pu->tipo == "Local comercial")
                          <option value="Locales comerciales">Locales comerciales</option>
                        @endif

                        @if($pu->tipo == "Bodega")
                          <option value="Bodegas">Bodegas</option>
                        @endif

                        @if($pu->tipo == "Punto fijo")
                          <option value="Puntos fijos">Puntos fijos</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Cantidad</label></center>
                    <center><input type="number" name="dictamenes[cantidad][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Equipo utilizado</label></center>
                    <center><input type="text" name="dictamenes[equipo][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Fecha expedicion (desde)</label></center>
                    <center><input type="date" name="dictamenes[fecha_des][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Fecha expedicion (hasta)</label></center>
                    <center><input type="date" name="dictamenes[fecha_has][]" value=""></center>
                  </div>
                  <div class="col-md-2 form-group">
                    <center><label>Fecha autodeclaracion</label></center>
                    <center><input type="date" name="dictamenes[fecha_auto][]" value=""></center>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer" style="width:95%; margin-left:40px; margin-bottom:15px">
              <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
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
$(function() {
  var count = 1;
   $(document).on("click","#btnadd",function( event ) {
    count++;
    $('#dic').after(
      '<div class="col-md-12">'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Inspector</label></center>'+' '+
          '<select class="form-control" name="dictamenes[inspector][]">'+' '+
            '@foreach($inspectores as $inspector)'+' '+
            '<option value="{{$inspector->id}}">{{$inspector->nombres}} {{$inspector->apellidos}}</option>'+' '+
            '@endforeach'+' '+
          '</select>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Matricula profesional</label></center>'+' '+
          '<center><input type="text" name="dictamenes[matricula][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Director tecnico</label></center>'+' '+
          '<select class="form-control" name="dictamenes[director][]">'+' '+
            '@foreach($inspectores as $inspector)'+' '+
              '@if($inspector->rol_inspector == "Director tecnico")'+' '+
              '<option value="{{$inspector->nombres}} {{$inspector->apellidos}}">{{$inspector->nombres}} {{$inspector->apellidos}}</option>'+' '+
              '@endif'+' '+
            '@endforeach'+' '+
          '</select>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Matricula profesional</label></center>'+' '+
          '<center><input type="text" name="dictamenes[matricula_dir][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Codigo Dictamen(es)</label></center>'+' '+
          '<center><input type="text" name="dictamenes[codigo][]" value="{{$contrato->codigo_proyecto}}"></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd" style="background-color: #fdea08; border-color:#fdea08; margin-top: 34px;"><i class="glyphicon glyphicon-plus"></i></a></center>'+' '+
        '</div>'+' '+
      '</div>'+' '+
      '<div class="col-md-12 dic">'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Proceso dictaminado</label></center>'+' '+
          '<select class="form-control" name="dictamenes[proceso][]">'+' '+
            '<option value=""></option>'+' '+
            '@if($cantidad_t > 0)'+' '+
              '<option value="Transformacion">Transformacion</option>'+' '+
            '@endif'+' '+
            '@if($cantidad_dm > 0))'+' '+
              '<option value="Red MT (m)">Red MT (m)</option>'+' '+
            '@endif'+' '+
            '@if($cantidad_db > 0))'+' '+
              '<option value="Red BT (m)">Red BT (m)</option>'+' '+
            '@endif'+' '+
            '@foreach($pu_final as $pu)'+' '+
              '@if($pu->tipo == "Casa")'+' '+
                '<option value="Casas">Casas</option>'+' '+
              '@endif'+' '+
              '@if($pu->tipo == "Apartamentos")'+' '+
                '<option value="Apartamentos">Apartamentos</option>'+' '+
              '@endif'+' '+
              '@if($pu->tipo == "Zonas")'+' '+
                '<option value="Zonas comunes">Zonas comunes</option>'+' '+
              '@endif'+' '+
              '@if($pu->tipo == "Local comercial")'+' '+
                '<option value="Locales comerciales">Locales comerciales</option>'+' '+
              '@endif'+' '+
              '@if($pu->tipo == "Bodega")'+' '+
                '<option value="Bodegas">Bodegas</option>'+' '+
              '@endif'+' '+
              '@if($pu->tipo == "Punto fijo")'+' '+
                '<option value="Puntos fijos">Puntos fijos</option>'+' '+
              '@endif'+' '+
            '@endforeach'+' '+
          '</select>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Cantidad</label></center>'+' '+
          '<center><input type="number" name="dictamenes[cantidad][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Equipo utilizado</label></center>'+' '+
          '<center><input type="text" name="dictamenes[equipo][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Fecha expedicion (desde)</label></center>'+' '+
          '<center><input type="date" name="dictamenes[fecha_des][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Fecha expedicion (hasta)</label></center>'+' '+
          '<center><input type="date" name="dictamenes[fecha_has][]" value=""></center>'+' '+
        '</div>'+' '+
        '<div class="col-md-2 form-group">'+' '+
          '<center><label>Fecha autodeclaracion</label></center>'+' '+
          '<center><input type="date" name="dictamenes[fecha_auto][]" value=""></center>'+' '+
        '</div>'+' '+
      '</div>'
    );
    $("select").select2();

   });

});

$(document).on('change','#inspector',function(){
  alert("holi")
  var ins_id = $(this).val();
  var div = $(this).parents();
  var op=" ";
  $.ajax({
    type:'get',
    url:'{{ url('selectmatri')}}',
    data:{'id':ins_id},
    success:function(data){
      console.log(data);

      op+='"' +data[i].matricula+ '"'

      div.find('.matri').html(" ");
      div.find('.matri').val(op);

    },
    error:function(){

    }
  });
});
</script>

@endsection
