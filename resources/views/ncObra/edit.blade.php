@extends('index')

@section('contenido')
  <ol class="breadcrumb">
    <li><a href="{{ url('inicio') }}">Inicio</a></li>
    <li><a href="{{ url('ncObra') }}">Reporte de no conformidades</a></li>
    <li class="active">Editar reporte de no conformidades</li>
  </ol>
  <div class="container" style=" margin-left: 0px; margin-right: 0px; width:100%">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 >Estado de la No conformidad (A : Abierta  C : Cerrada   N/A : No Aplica) </h3>
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
          <form class="" action="{{ url('ncObra/update')}}" method="post">
            {{ csrf_field() }}

            <div class="col-md-12">
              <div class="col-md-12">
                <input type="button" id="añadirFila" class="btn btn-primary pull-right " style="background-color: #33579A; border-color:#33579A;" value="agregar fila">
              </div>
            </div>
            @foreach($descripciones as $key =>$descripcion)
            <div class="col-md-12" id="fila1">
              <div class="col-md-3">
                <div class="col-md-12">
                  <p style="margin-top: 32px;">{{$descripcion->descripcion}}</p>
                  <input type="hidden" name="descripcion[{{$key+1}}]" value="{{$descripcion->descripcion}}">
                  <input type="hidden" name="descripcion_id[{{$key+1}}]" value="{{$descripcion->id}}">
                </div>
              </div>
              <div class="col-md-9">


                @inject('nc','App\Http\Controllers\NcController')
                @foreach($nc->ncs($descripcion->id) as $key2 => $registro)

                  @foreach($registro as $reg)
                    <div class="col-md-1" id="nc1">
                      <div class="form-group">
                        <center><label >NC1</label></center>
                        <select class="form-control" name="nc[{{$key+1}}][]">
                          <option>{{$reg->nc}}</option>
                          <option>A</option>
                          <option>C</option>
                          <option>N/A</option>
                        </select>
                        <input type="hidden" name="nc_id[{{$key+1}}][]" value="{{$reg->id}}">
                      </div>
                    </div>
                  @endforeach

                @endforeach

                <div class="col-md-1">
                  <input type="button" id="añadirNC" class="btn btn-primary " style="background-color: #33579A; border-color:#33579A;margin-top: 26px;" value="agregar NC">
                </div>
              </div>
            </div>
            @endforeach
            <div class="box-footer" style="width:95%; margin-left:40px; margin-bottom:15px">
              <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->



    </div>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">

$(function() {
  var count = 1;
  var count2 = 0;
   $(document).on("click","#añadirFila",function( event ) {
    count++;
    count2++;
    $('#fila'+count2+'').after(
        '<div class="col-md-12" id="fila'+count+'">'+' '+
          '<div class="col-md-3">'+' '+
            '<div class="col-md-12">'+' '+
              '<p style="margin-top: 32px;">Informe de No conformidades de Obra N.'+count+'</p>'+' '+
              '<input type="hidden" name="descripcion['+count+']" value="Informe de No conformidades de Obra N.'+count+'">'+' '+
            '</div>'+' '+
          '</div>'+' '+
          '<div class="col-md-9">'+' '+
            '<div class="col-md-1" id="nc1">'+' '+
              '<div class="form-group">'+' '+
                '<center><label >NC1</label></center>'+' '+
                '<input type="hidden" class="numero" value="'+count+'">'+' '+
                '<select class="form-control" name="nc['+count+'][]" >'+' '+
                  '<option></option>'+' '+
                  '<option>A</option>'+' '+
                  '<option>C</option>'+' '+
                  '<option>N/A</option>'+' '+
                '</select>'+' '+
              '</div>'+' '+
            '</div>'+' '+
            '<div class="col-md-1">'+' '+
              '<input type="button" id="añadirNC'+count+'" class="btn btn-primary " style="background-color: #33579A; border-color:#33579A;margin-top: 26px;" value="agregar NC">'+' '+
            '</div>'+' '+
          '</div> '+' '+
      '</div>'
    );

    $(function() {
      var count3 = 1;
      var count4 = 0;
       $(document).on("click","#añadirNC"+count+"",function( event ) {
        count3++;
        count4++;
        var numero = $(this).parent().parent().find('.numero').val();
        $(this).parent().parent().find('#nc'+count4+'').after(
          '<div class="col-md-1" id="nc'+count3+'">'+' '+
            '<div class="form-group">'+' '+
              '<center><label >NC'+count3+'</label></center>'+' '+
              '<select class="form-control" name="nc['+numero+'][]">'+' '+
                '<option></option>'+' '+
                '<option>A</option>'+' '+
                '<option>C</option>'+' '+
                '<option>N/A</option>'+' '+
              '</select>'+' '+
            '</div>'+' '+
          '</div>'
        );
        $("select").select2();

       });

    });
    $("select").select2();
   });

});


$(function() {
  var count = 1;
  var count2 = 0;
   $(document).on("click","#añadirNC",function( event ) {
    count++;
    count2++;
    $(this).parent().parent().find('#nc'+count2+'').after(
      '<div class="col-md-1" id="nc'+count+'">'+' '+
        '<div class="form-group">'+' '+
          '<center><label >NC'+count+'</label></center>'+' '+
          '<select class="form-control" name="nc[1][]">'+' '+
            '<option></option>'+' '+
            '<option>A</option>'+' '+
            '<option>C</option>'+' '+
            '<option>N/A</option>'+' '+
          '</select>'+' '+
        '</div>'+' '+
      '</div>'
    );
    $("select").select2();

   });

});



</script>

@endsection
