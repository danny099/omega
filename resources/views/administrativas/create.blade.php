@extends('index')

@section('css')



@endsection

@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas') }}">Administrativa</a></li>
  <li class="active">Crear Proyecto</li>
</ol>
<div class="box box-primary">


  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3> </center>
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
  <form role="form" name="form1" action="{{ url('administrativas') }}" method="post">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="col-md-4">
        <div class="form-group">
          <label >Codigo del proyecto:</label>
          <input id="codigo" type="text" class="form-control" placeholder="Ingrese codigo"  name="codigo" required>
        </div>
        <div class="form-group">
          <label >nombre del proyecto</label>
          <input type="text" class="form-control" placeholder="Ingrese nombre" name="nombre">
        </div>
        <div class="form-group">
          <label >Fecha del contrato:</label>
          <input type="date" class="form-control" name="fecha" >
        </div>
        <div class="form-group" >
          <label >Tipo cliente</label>
          <select class="form-control" name="cliente_id" id="cliente" required="">
            <option value="">Seleccione</option>
            <option value="1">Persona narural</option>
            <option value="2">Persona juridica</option>
          </select>
        </div>
        <div class="form-group" style="Display:none" id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="Display:none" id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" >
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Departamento</label>
            <select class="form-control" name="departamento" id="departamento">
              @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
          <label >Municipios</label>
            <select class="form-control" name="municipio" id="municipio">
              <option value=""></option>
            </select>
        </div>
        <div class="form-group">
          <label >Tipo de zona</label>
          <select class="form-control" name="zona">
              <option value="Urbana">Urbana</option>
              <option value="Rural">Rural</option>

          </select>
        </div>

        <div class="form-group">
          <label >Valor antes del iva</label>
          <input type="number" id="ini" class="form-control" placeholder= "Ingrese valor" name="contrato_inicial" onkeyup="sumar()" required="ingrese asi sea un cero">
        </div>

      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Valor iva</label>
          <input type="number" class="form-control" id="iva" readonly="readonly" placeholder= "valor iva" name="iva"   >
        </div>

        <label >Valor adicional</label>
        <div class="form-group ">
          <div class="col-md-11" >
            <input type="number" class="form-control" id="adicional" placeholder= "Ingrese valor" name="adicional[]"  onkeyup="sumar()" >
            <label >detalle valor adicional</label>
            <input type="text" class="form-control" id="detalle" placeholder= "Ingrese detalle" name="detalle[]"  >
          </div>

          <div class="col-md-1" id="tblprod5">
            <a class="btn btn-warning" id="btnadd5" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>

        <label >Otro si</label>
        <div class="form-group ">
          <div class="col-md-11" >
            <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar()" >
          </div>

          <div class="col-md-1" id="tblprod">
            <a class="btn btn-warning" id="btnadd" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
          </div>


          <div class="form-group">
            <br>
            <br>
            <label >Valor contrato final</label>
            <input type="number" class="form-control" id="fin" readonly="readonly" placeholder= "Valor final" name="contrato_final"   >
          </div>

          <div class="form-group">
            <label >Plan de pago</label>
            <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago">
          </div>
        </div>
      </div>
      <hr>

</div>
</div>


<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
  </div>

    <div class="box-body">
    <div class="col-md-12">

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripcion</label></center>
          <input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="transformacion[descripcion][]">
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="transformacion[tipo][]">
            <option value="">Seleccione..</option>
            <option value="tipo_poste">tipo poste</option>
            <option value="tipo_interior">tipo interior</option>
            <option value="tipo_exterior">tipo exterior</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Capacidad</label></center>
          <select class="form-control" name="transformacion[capacidad][]">

            <option value="5KVA">5KVA</option>
            <option value="10KVA">10KVA</option>
            <option value="15KVA">15KVA</option>
            <option value="150KVA">150KVA</option>

          </select>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label>Unidad</label></center>
          <center>
            <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]">
          </center>
        </div>
      </div>

      <div class="col-md-1">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]">
        </div>
      </div>

      <div class="col-md-1" id="tblprod2">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>
</div>
      <div class="col-md-12">
        <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripcion</label></center>
          <select class="form-control" name="distribucion[descripcion_dis][]">
            <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
            <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="distribucion[tipo_dis][]">

            <option value="aerea">tipo Aerea</option>
            <option value="subterranea">tipo subterranea</option>

          </select>
        </div>
      </div>



      <div class="col-md-2">
        <div class="form-group">
          <center><label >Unidad</label></center>
          <center>
            <input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center">
          </center>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">
        </div>
      </div>

      <div class="col-md-1" id="tblprod3" >
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>

      <div class="col-md-12">
        <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <center><label >Descripcion</label></center>
          <select class="form-control"name="pu_final[descripcion_pu][]">

            <option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option>
            <option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option>

          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <center><label >Tipo</label></center>
          <select class="form-control" name="pu_final[tipo_pu][]">

            <option value="Casa">Casa</option>
            <option value="Apartamentos">Apartamentos</option>
            <option value="Zona comun">Zona comun</option>
            <option value="Local comercial">Local comercial</option>
            <option value="Punto fijo">Punto fijo</option>

          </select>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <center><label >Unidad</label></center>
          <center>
            <input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]">
          </center>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <center><label >Cantidad</label></center>
          <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">
        </div>
      </div>

      <div class="col-md-1" id="tblprod4">
        <div class="form-group">
          <br>
          <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd4" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
      </div>

      <div class="col-md-12">
        <center> <h4 class="box-title">Observaciones de estado administrativo del proyecto</h4> </center>
      </div>

      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="resumen"></textarea>
      </div>
    </div>
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="  " class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
      </div>


      <div class="modal fade" id="pagos" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">

                <h1>¿Desea hacer un pago?</h1>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-right" onclick="pregunta()" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
          <!-- /.modal-content -->

        </div>
    </form>
  </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#departamento',function(){

      var dep_id = $(this).val();
      var div = $(this).parents();
      var op=" ";
      $.ajax({
        type:'get',
        url:'{{ url('selectmuni')}}',
        data:{'id':dep_id},
        success:function(data){
          console.log(data);
          op+='<option value="0" selected disabled>Seleccione</option>';

          for (var i = 0; i < data.length; i++) {
            op+='<option value="' +data[i].id+ '">' +data[i].nombre+ '</option>'
          }

          div.find('#municipio').html(" ");
          div.find('#municipio').append(op);

        },
        error:function(){

        }
      });
    });
  });
</script>


<script type="text/javascript">
  function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?')){
       document.form.submit()
    }
  }

  function sumar(){
    var valor = parseInt(document.getElementById('ini').value);

    var resultado = valor*1.19;
    var iva = valor*0.19;
    document.getElementById('iva').value = iva ;
    document.getElementById('fin').value = resultado ;
      }


</script>

  <script type="text/javascript">
    $(function() {
        var count = 1;
       $(document).on("click","#btnadd",function( event ) {
        count++;
        $('#tblprod').after('<div class="col-md-11" id="quitar17"><input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar()" > </div>   <div class="col-md-1" id="quitar18"><a class="btn btn-warning delete" id="btnadd[]" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div>');
          event.preventDefault();
       });
       $(document).on("click",".delete",function( event ) {
         $('#quitar17').remove();
         $('#quitar18').remove();
          return false;
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd5",function( event ) {
        count++;
        $('#tblprod5').after('<div class="col-md-11" id="quitar15"> <label>Valor adicional</label> <input type="number" class="form-control" id="adicional[]" placeholder= "Ingrese valor" name="adicional[]"  onkeyup="sumar()" > <label >detalle valor adicional</label><input type="text" class="form-control" id="detalle" placeholder= "Ingrese detalle" name="detalle[]" ></div>   <div class="col-md-1" id="quitar16"><a class="btn btn-warning delete5" id="btnadd[]" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div>');
          event.preventDefault();
       });
       $(document).on("click",".delete5",function( event ) {
         $('#quitar16').remove();
         $('#quitar15').remove();
            return false;
       });
    });



    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after(' <div class="col-md-1" id="tblprod2"><div class="form-group"><br><a class="btn btn-primary delete2" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
          event.preventDefault();
       });
         $(document).on("click",".delete2",function( event ) {
         $(this).closest("div").remove();
         $('#quitar1').remove();
         $('#quitar2').remove();
         $('#quitar3').remove();
         $('#quitar4').remove();
         $('#quitar5').remove();
            return false;
         });
    });


    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after('<div class="col-md-1" id="quitar1"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]"></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after('<div class="col-md-1" id="quitar2"><div class="form-group"><center><label>Unidad</label></center><center><input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]"></center></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after('<div class="col-md-3" id="quitar3"><div class="form-group"><center><label >Capacidad</label></center><select class="form-control" name="transformacion[capacidad][]"><option value="5KVA">5KVA</option><option value="10KVA">10KVA</option><option value="15KVA">15KVA</option><option value="150KVA">150KVA</option></select></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after('<div class="col-md-3" id="quitar4"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="transformacion[tipo][]"><option value="tipo_poste">tipo poste</option><option value="tipo_interior">tipo interior</option><option value="tipo_exterior">tipo exterior</option></select></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('#tblprod2').after('<div class="col-md-3" id="quitar5"><div class="form-group"><center><label >Descripcion</label></center><input type="text" class="form-control" value="Inspecion RETIE proceso de transformacion"  readonly=”readonly” name="transformacion[descripcion][]"></div</div>');
          event.preventDefault();
       });
    });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('#tblprod3').after(' <div class="col-md-1" id="tblprod2"><div class="form-group"><br><a class="btn btn-primary delete3" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
              event.preventDefault();
           });
             $(document).on("click",".delete3",function( event ) {
             $(this).closest("div").remove();
             $('#quitar6').remove();
             $('#quitar7').remove();
             $('#quitar8').remove();
             $('#quitar9').remove();
                return false;
             });
        });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('#tblprod3').after('<div class="col-md-2 " id="quitar6"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]"></div></div>');
              event.preventDefault();
           });
        });

        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('#tblprod3').after('<div class="col-md-2 " id="quitar7"><div class="form-group"><center><label >Unidad</label></center><center><input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center"></center></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('#tblprod3').after('<div class="col-md-3 " id="quitar8"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="distribucion[tipo_dis][]"><option value="aerea">tipo Aerea</option><option value="subterranea">tipo subterranea</option></select></div></div>');
              event.preventDefault();
           });
        });

        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('#tblprod3').after('<div class="col-md-3 " id="quitar9"><div class="form-group"><center><label >Descripcion</label></center><select class="form-control" name="distribucion[descripcion_dis][]"><option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option><option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option></select></div></div>');
              event.preventDefault();
           });
        });





        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('#tblprod4').after(' <div class="col-md-1" ><div class="form-group"><br><a class="btn btn-primary delete4" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
              event.preventDefault();
           });
             $(document).on("click",".delete4",function( event ) {
             $(this).closest("div").remove();
             $('#quitar10').remove();
             $('#quitar11').remove();
             $('#quitar12').remove();
             $('#quitar13').remove();
                return false;
             });
        });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('#tblprod4').after('<div class="col-md-2"id="quitar10"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]"></div></div>');
              event.preventDefault();
           });
        });
        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('#tblprod4').after('<div class="col-md-2" id="quitar11"><div class="form-group"><center><label >Unidad</label></center><center><input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]"></center></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('#tblprod4').after('<div class="col-md-3" id="quitar12"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="pu_final[tipo_pu][]"><option value="Casa">Casa</option><option value="Apartamentos">Apartamentos</option><option value="Zona comun">Zona comun</option><option value="Local comercial">Local comercial</option><option value="Punto fijo">Punto fijo</option></select></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('#tblprod4').after('<div class="col-md-3" id="quitar13"><div class="form-group"><center><label >Descripcion</label></center><select class="form-control"name="pu_final[descripcion_pu][]"><option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option><option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option></select></div></div>');
              event.preventDefault();
           });
        });


        $('#cliente').change(function(){
            var valorCambiado =$(this).val();
            if((valorCambiado == "1")){
              $('#natural').css('display','block');
               $('#juridica').css('display','none');
             }
             else if(valorCambiado == "2")
             {
               $('#juridica').css('display','block');
                $('#natural').css('display','none');
             }
        });

        $(document).ready(function(){
          $(".select2").select2();
        });


    </script>

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->

@endsection
