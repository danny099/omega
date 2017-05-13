



  function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?')){
       document.form.submit()
    }
  }
  function sumariva(){
    var valor = parseInt(document.getElementById('valor_factura').value);
    var resultado = valor*1.19;

    var iva = valor*0.19;

    document.getElementsBy('iva').value = iva ;
    document.getElementById('valor_total').value = resultado ;
  }

  function sumar(){
    var valor = parseInt(document.getElementById('ini').value);
    var resultado = valor*1.19;

    var iva = valor*0.19;

    document.getElementById('iva').value = iva ;
    document.getElementById('fin').value = resultado ;
      }

      function sumar3(){
        var valor = parseInt(document.getElementById('valor_contrato_inicial').value);
        var resultado = valor*1.19;

        var iva = valor*0.19;

        document.getElementById('iva').value = iva ;
        document.getElementById('fin').value = resultado ;
          }





    $(function() {
        var count = 1;
       $(document).on("click","#btnadd",function( event ) {
        count++;
        $('#tblprod').after('<div class="col-md-11" id="quitar17"><input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar2()" > </div>   <div class="col-md-1" id="quitar18"><a class="btn btn-warning delete" id="btnadd[]" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div>');
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
        $('#tblprod5').after('<div class="col-md-11" id="quitar15"> <label>Valor adicional</label> <input type="number" class="form-control" id="adicional[valor][]" placeholder= "Ingrese valor" name="adicional[valor][]"  onkeyup="sumar()" > <label >detalle valor adicional</label><input type="text" class="form-control" id="adicional[detalle][]" placeholder= "Ingrese detalle" name="adicional[detalle][]" ></div><div class="col-md-1" id="quitar16"><a class="btn btn-warning delete5" id="btnadd[]" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div>');
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
          $("select").select2();
        });
