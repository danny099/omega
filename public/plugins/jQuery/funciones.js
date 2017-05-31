



  function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?')){
       document.form.submit()
    }
  }
  function sumariva(){
    var valor = document.getElementById('valor_factura').value;
    var resultado = valor*1.16;

    var iva = valor*0.16;

    document.getElementsBy('iva').value = iva ;
    document.getElementById('valor_total').value = resultado ;
  }

  function sumar(){
    var valor = parseInt(document.getElementById('ini').value);
    var resultado = valor*1.16;

    var iva = valor*0.16;

    document.getElementById('iva').value = iva ;
    document.getElementById('fin').value = resultado ;
      }

      function sumar3(){
        var valor = parseInt(document.getElementById('valor_contrato_inicial').value);
        var resultado = valor*1.16;

        var iva = valor*0.16;

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
        $('#tblprod5').after('<div class="row" id="quitar15"><div class="col-md-12"><div class="col-md-3"><div class="form-group"><center><label >Valor adicional</label></center><input type="text" class="form-control" placeholder= "Valor" onkeypress="mascara(this,cpf)" name="adicional[valor][]" required=""></div></div><div class="col-md-5"><div class="form-group"><center><label >Detalle</label></center><input type="text" class="form-control" placeholder= "Detalle" name="adicional[detalle][]"required=""></div></div><div class="col-md-1" id="tblprod5" ><div class="form-group"><br><a class="btn btn-warning delete5" id="btnadd[]" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div></div>'


      );
          event.preventDefault();
       });
       $(document).on("click",".delete5",function( event ) {
         $(this).closest("#quitar15").remove();
            return false;
       });
    });



    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after(' <div class="col-md-1 " id="tblprod2"><div class="form-group"><br><a class="btn btn-primary delete2" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
          event.preventDefault();
       });
         $(document).on("click",".delete2",function( event ) {
           $('#quitar1').remove();
           $('#quitar2').remove();
           $('#quitar3').remove();
           $('#quitar4').remove();
           $('#quitar5').remove();
           $('#tblprod2').remove();
            return false;
         });
    });


    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after('<div class="col-md-1" id="quitar1"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]"></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after('<div class="col-md-1" id="quitar2"><div class="form-group"><center><label>Unidad</label></center><center><input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="transformacion[unidad_transformacion][]"></center></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after('<div class="col-md-3" id="quitar3"><div class="form-group"><center><label >Capacidad</label></center><input type="text" class="form-control" placeholder="Capacidad"   name="transformacion[capacidad][]"></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after('<div class="col-md-3" id="quitar4"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="transformacion[tipo][]"><option value="Tipo_poste">Tipo poste</option><option value="Tipo_interior">Tipo interior</option><option value="Tipo_exterior">Tipo exterior</option></select></div></div>');
          event.preventDefault();
       });
    });

    $(function() {
        var count = 1;
       $(document).on("click","#btnadd2",function( event ) {
        count++;
        $('.tblprod2').after('<div class="col-md-3" id="quitar5"><div class="form-group"><center><label >Descripción</label></center><input type="text" class="form-control" value="Inspección RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]"></div</div>');
          event.preventDefault();
       });
    });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('.tblprod3').after(' <div class="col-md-1" id="tblprod3"><div class="form-group"><br><a class="btn btn-primary delete3" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
              event.preventDefault();
           });
             $(document).on("click",".delete3",function( event ) {


             $('#quitar6').remove();
             $('#quitar7').remove();
             $('#quitar8').remove();
             $('#quitar9').remove();
             $('#tblprod3').remove();

                return false;
             });
        });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('.tblprod3').after('<div class="col-md-2 " id="quitar6"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]"></div></div>');
              event.preventDefault();
           });
        });

        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('.tblprod3').after('<div class="col-md-2 " id="quitar7"><div class="form-group"><center><label >Unidad</label></center><center><input type="text" class="form-control" value="km"  readonly=”readonly” name="distribucion[unidad_distribucion][]"style="text-align:center"></center></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('.tblprod3').after('<div class="col-md-3 " id="quitar8"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="distribucion[tipo_dis][]"><option value="">Seleccione..</option><option value="Aérea">tipo Aérea</option><option value="Subterránea">tipo subterránea</option><option value="Aérea/subterrénea">Aérea/Subterrénea</option></select></div></div>');
              event.preventDefault();
           });
        });

        $(function() {
            var count = 1;
           $(document).on("click","#btnadd3",function( event ) {
            count++;
            $('.tblprod3').after('<div class="col-md-4 " id="quitar9"><div class="form-group"><center><label >Descripción</label></center><select class="form-control" name="distribucion[descripcion_dis][]"><option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option><option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option></select></div></div>');
              event.preventDefault();
           });
        });





        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('.tblprod4').after(' <div class="col-md-1" id="tblprod4"><div class="form-group"><br><a class="btn btn-primary delete4" data-toggle="modal" href="#"  style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a></div></div>');
              event.preventDefault();
           });
             $(document).on("click",".delete4",function( event ) {

             $('#quitar10').remove();
             $('#quitar11').remove();
             $('#quitar12').remove();
             $('#quitar13').remove();
             $('#tblprod4').remove();
                return false;
             });
        });


        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('.tblprod4').after('<div class="col-md-2"id="quitar10"><div class="form-group"><center><label >Cantidad</label></center><input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]"></div></div>');
              event.preventDefault();
           });
        });
        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('.tblprod4').after('<div class="col-md-2" id="quitar11"><div class="form-group"><center><label >Unidad</label></center><center><input style="text-align:center;" type="text" class="form-control" value="Und"  readonly=”readonly” name="pu_final[unidad_pu_final][]"></center></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('.tblprod4').after('<div class="col-md-3" id="quitar12"><div class="form-group"><center><label >Tipo</label></center><select class="form-control" name="pu_final[tipo_pu][]"><option value="Casa">Casa</option><option value="Apartamentos">Apartamentos</option><option value="Zona común">Zona común</option><option value="Local comercial">Local comercial</option><option value="Punto fijo">Punto fijo</option></select></div></div>');
              event.preventDefault();
           });
        });



        $(function() {
            var count = 1;
           $(document).on("click","#btnadd4",function( event ) {
            count++;
            $('.tblprod4').after('<div class="col-md-4" id="quitar13"><div class="form-group"><center><label >Descripción</label></center><select class="form-control"name="pu_final[descripcion_pu][]"><option value="Inspección retie proceso uso final residencial">Inspección RETIE proceso uso final residencial</option><option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option></select></div></div>');
              event.preventDefault();
           });
        });


        $('#cliente').change(function(){
            var valorCambiado =$(this).val();
            if((valorCambiado == "1")){
              $('#natural').css('display','block');
               $('#juridica').css('display','none');
               $("#select-natural").prop('required',true);
               $("#juri").prop('required',false);
             }
             else if(valorCambiado == "2")
             {
               $('#juridica').css('display','block');
                $('#natural').css('display','none');
                $("#juri").prop('required',true);
                $("#select-natural").prop('required',false);

             }
        });

        $(document).ready(function(){
          $("select").select2();
        });




       $('.valor').keyup(function(){
           var valor = $(this).val().replace(/,/g,"");
           var resultado = valor * 1.16;
           var iva = valor*0.16;
           $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
           $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));


       });
          $('.valor_factura').keyup(function(){
              var valor = $(this).val().replace(/,/g,"");
              var resultado = valor * 1.16;
              var iva = valor*0.16;
              $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
              $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));


              var retenciones = parseInt($(this).parent().parent().parent().find('.retenciones').val());
              var amortizacion = parseInt($(this).parent().parent().parent().find('.amortizacion').val());
              var polizas = parseInt($(this).parent().parent().parent().find('.polizas').val());
              var retegarantia = parseInt($(this).parent().parent().parent().find('.retegarantia').val());
              var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
              var resultado =valor_total-(retenciones+amortizacion+polizas+retegarantia);
              $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));


          });
          $('.retencionesporcen').keyup(function(){
            var retencionesporcen = parseFloat($(this).val().replace(/,/g,"."));
            var valor = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
            var resultado = valor*retencionesporcen/100;
            $(this).parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado)));
          });
          $('.retencionesporcen').change(function(){
            var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
            var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
            var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
            var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
            var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
            var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
            $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
          });

          $('.amortizacion').keyup(function(){
            var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
            var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
            var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
            var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
            var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
            var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
            $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
            });

          $('.polizas').keyup(function(){
            var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
            var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
            var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
            var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
            var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
            var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
            $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
          });
          $('.retegarantiaporcen').keyup(function(){
            var retegarantiaporcen = parseFloat($(this).val().replace(/,/g,"."));
            var valor = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
            var resultado = valor*retegarantiaporcen/100;
            $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado)));
          });
          $('.retegarantiaporcen').change(function(){
            var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
            var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
            var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
            var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
            var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
            var resultado =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
            $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado)));
          });

          $('.retencionesporcen').focus(function(){
            var retenciones = parseInt($(this).val(""));
          });
          $('.amortizacion').focus(function(){
            var amortizacion = parseInt($(this).val(""));
          });
          $('.polizas').focus(function(){
            var polizas = parseInt($(this).val(""));
          });
          $('.retegarantiaporcen').focus(function(){
            var retegarantia = parseInt($(this).val(""));
          });
          $(document).ready(function() {
            setTimeout(function() {
                $("#alert").fadeOut(1500);
            },3000);
          });


      //   $('.form1').on('submit',function() {
      // // Enviamos el formulario usando AJAX
      //         $.ajax({
      //             type: 'POST',
      //             url: $(this).attr('action'),
      //             data: $(this).serialize(),
      //           // Mostramos un mensaje con la respuesta de PHP
      //             success: function() {
      //               alert('Valor adicional editado');
      //               $('.modal').modal('hide');
      //             }
      //         })
      //         return false;
      //     });
      //
      //     $('.form2').on('submit',function() {
      //   // Enviamos el formulario usando AJAX
      //           $.ajax({
      //               type: 'POST',
      //               url: $(this).attr('action'),
      //               data: $(this).serialize(),
      //             // Mostramos un mensaje con la respuesta de PHP
      //               success: function() {
      //                 alert('Observacion agregada');
      //                 $('.modal').modal('hide');
      //               }
      //           })
      //           return false;
      //       });
