

  function pregunta(){
    if (confirm('¿Estas seguro de enviar este formulario?')){
       document.form.submit()
    }
  }
  function sumariva(){
    var valor = document.getElementById('valor_factura').value;
    var resultado = valor*1.19;

    var iva = valor*0.19;

    document.getElementsBy('iva').value = iva ;
    document.getElementById('valor_total').value = resultado ;
  }

  function sumar(){
    var valor = parseInt(document.getElementById('ini').value);
    var resultado = valor*1.19

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

          var tension = 0;
        $(document).on('change','.tension',function(){

            tension = $(this).val();
            $(".tension2").html('');
            $(".tension2").append('<option value="'+tension+'">'+tension+'</option>');

        });

        var tension = 0;
      $(document).on('change','.tension',function(){

          tension = $(this).val();
          $(".tension3").html('');
          $(".tension3").append('<option value="'+tension+'">'+tension+'</option>');

      });

      var tension = 0;
    $(document).on('change','.tension',function(){

        tension = $(this).val();
        $(".tension4").html('');
        $(".tension4").append('<option value="'+tension+'">'+tension+'</option>');

    });

          // funcion encargada de manejar dinamicamente (eliminar y agregar campos) de el proceso de distribucion en MT
          $(function() {
              var count = 1;
             $(document).on("click","#btnadd13",function( event ) {

              count++;
              $('#tblprod13').after(
                '<div class="row quitar51" id="quitar51">'+' '+
                  '<div class="col-md-12">'+' '+
                    '<div class="col-md-3">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Descripción</label></center>'+' '+
                        '<input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en MT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Tipo</label></center>'+' '+
                        '<select class="form-control tipo2 tipo" style="width:100%"  name="distribucion[tipo_dis][]" id="tipo">'+' '+
                          '<option value="">Seleccione...</option>'+' '+
                          '<option value="Aérea">Tipo Aérea</option>'+' '+
                          '<option value="Subterránea">Tipo subterránea</option>'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Nivel de tensión (KV)  </label></center>'+' '+
                         '<select class="form-control tipo2 tension3" style="width:100%" name="distribucion[nivel_tension_dis][]" id="tension">'+' '+
                            '<option value="">Seleccione...</option>'+' '+
                            '<option value="13,2">13,2</option>'+' '+
                            '<option value="13,4">13,4</option>'+' '+
                            '<option value="13,8">13,8</option>'+' '+
                          '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+

                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Longitud de red (mts.)</label></center>'+' '+
                        '<input type="text" class="form-control cantidad2" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Apoyos o estructuras</label></center>'+' '+
                        '<input type="text" class="form-control apoyos" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" id="apoyos">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Cajas de inspección</label></center>'+' '+
                        '<input type="text" class="form-control cajas" placeholder= "Cantidad" name="distribucion[cajas_dis][]" id="cajas">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 tblprod13" >'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"></center>'+' '+
                        '<a class="btn btn-primary delete53" data-toggle="modal" id="delete53" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                '</div>'+' '+
              '</div>'
            );
            if (tension == 0) {

            }
            else {
              $(".tension3").html('');
              $(".tension3").append('<option value="'+tension+'">'+tension+'</option>');
            }
                event.preventDefault();
                $("select").select2();
             });

             $(document).on("click",".delete53",function( event ) {
               $(this).closest("#quitar51").remove();
                  return false;
             });
          });


          // funcion encargada de manejar dinamicamente (eliminar y agregar campos) de el proceso de transformacion
          $(function() {
              var count = 1;
             $(document).on("click","#btnadd10",function( event ) {
              count++;
              $('#tblprod10').after(
              '<div class="row quitar50" id="quitar50">'+' '+
              '<div class="col-md-12">'+' '+
                '<div class="col-md-3">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Descripción</label></center>'+' '+
                    '<input type="text" class="form-control desc" value="Inspección  RETIE proceso de transformación"  readonly=”readonly” name="transformacion[descripcion][]">'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-2">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Tipo</label></center>'+' '+
                    '<select  style="width:100%" class="form-control tipo" name="transformacion[tipo][]">'+' '+
                      '<option value="">Seleccione...</option>'+' '+
                      '<option value="Poste">Tipo poste</option>'+' '+
                      '<option value="Interior">Tipo interior</option>'+' '+
                      '<option value="Pedestal/jardin">Tipo pedestal/jardin</option>'+' '+
                      '<option value="Patio">Tipo Patio</option>'+' '+
                    '</select>'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-1">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Nivel de tensión (KV)  </label></center>'+' '+
                    '<select style="width:100%" class="form-control tipo tension2" name="transformacion[nivel_tension][]" style="width:100%" id="kv">'+' '+
                      '<option value="">Seleccione...</option>'+' '+
                      '<option value="13,2">13,2</option>'+' '+
                      '<option value="13,4">13,4</option>'+' '+
                      '<option value="13,8">13,8</option>'+' '+
                      '<option value="No aplica">No aplica</option>'+' '+
                    '</select>'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-2">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Capacidad (KVA)</label></center>'+' '+
                      '<input type="text" class="form-control capacidad" placeholder="Capacidad"   name="transformacion[capacidad][]">'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-1">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Cantidad</label></center>'+' '+
                    '<input type="text" class="form-control cantidad" id="cantidad" placeholder= "Cantidad" name="transformacion[cantidad][]">'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-2">'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"><label >Refrigeración </label></center>'+' '+
                    '<select style="width:100%" class="form-control" name="transformacion[tipo_refrigeracion][]">'+' '+
                      '<option value="">Seleccione...</option>'+' '+
                      '<option value="Seco">Seco</option>'+' '+
                      '<option value="Aceite">Aceite</option>'+' '+
                    '</select>'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '<div class="col-md-1 tblprod10" >'+' '+
                  '<div class="form-group">'+' '+
                    '<center class="separar"></center>'+' '+
                    '<a class="btn btn-primary delete50" data-toggle="modal" href="#" id="delete50" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-minus"></i></a>'+' '+
                  '</div>'+' '+
                '</div>'+' '+
                '</div>'+' '+
              '</div>'
            );
            if (tension == 0) {

            }
            else {
              $(".tension2").html('');
              $(".tension2").append('<option value="'+tension+'">'+tension+'</option>');
            }

                event.preventDefault();
                $("select").select2();

             });
             $(document).on("click",".delete50",function( event ) {
               $(this).closest("#quitar50").remove();
                  return false;
             });
          });





          // funcion encargada de manejar dinamicamente (eliminar y agregar campos) de el proceso de distribucion BT
          $(function() {
              var count = 1;
             $(document).on("click","#btnadd11",function( event ) {

              count++;
              $('#tblprod11').after(
                '<div class="row quitar51" id="quitar51">'+' '+
                  '<div class="col-md-12">'+' '+
                    '<div class="col-md-3">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Descripción</label></center>'+' '+
                        '<input type="text" class="form-control desc2" value="Inspección RETIE proceso de distribución en BT" id="desc" readonly=”readonly” name="distribucion[descripcion_dis][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Tipo</label></center>'+' '+
                        '<select style="width:100%" class="form-control tipo2 tipo"  name="distribucion[tipo_dis][]" id="tipo">'+' '+
                          '<option value="">Seleccione...</option>'+' '+
                          '<option value="Aérea">Tipo Aérea</option>'+' '+
                          '<option value="Subterránea">Tipo subterránea</option>'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Nivel de tensión (KV)  </label></center>'+' '+
                         '<select style="width:100%" class="form-control tipo2" name="distribucion[nivel_tension_dis][]" id="tension">'+' '+
                            '<option value="">Seleccione...</option>'+' '+
                            '<option value="110-220">110-220</option>'+' '+
                            '<option value="220-240">220-240</option>'+' '+
                            '<option value="No aplica">No aplica</option>'+' '+
                          '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+

                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Longitud de red (mts.)</label></center>'+' '+
                        '<input type="text" class="form-control cantidad2" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Apoyos o estructuras</label></center>'+' '+
                        '<input type="text" class="form-control apoyos" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" id="apoyos">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Cajas de inspección</label></center>'+' '+
                        '<input type="text" class="form-control cajas" placeholder= "Cantidad" name="distribucion[cajas_dis][]" id="cajas">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 tblprod11" >'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"></center>'+' '+
                        '<a class="btn btn-primary delete51" data-toggle="modal" id="delete51" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                '</div>'+' '+
              '</div>'
            );
                event.preventDefault();
                $("select").select2();
             });

             $(document).on("click",".delete51",function( event ) {
               $(this).closest("#quitar51").remove();
                  return false;
             });
          });

          // funcion encargada de manejar dinamicamente (eliminar y agregar campos) de el proceso de uso final
          $(function() {
              var count = 1;
             $(document).on("click","#btnadd12",function( event ) {
              count++;
              $('#tblprod12').after(
                '<div class="row quitar52" id="quitar52">'+' '+
                    '<div class="col-md-12">'+' '+
                    '<div class="col-md-3">'+' '+
                      '<div class="form-group">'+' '+
                        '<center><label >Descripción</label></center>'+' '+
                        '<select style="width:100%" class="form-control desc3"name="pu_final[descripcion_pu][]" id="instalacion">'+' '+
                          '<option value="">Seleccione...</option>'+' '+
                          '<option value="Inspección RETIE proceso uso final residencial">Inspección RETIE proceso uso final residencial</option>'+' '+
                          '<option value="Inspección RETIE proceso uso final comercial">Inspección RETIE proceso uso final comercial</option>'+' '+
                          '<option value="Inspección RETIE proceso uso final industrial">Inspección RETIE proceso uso final industrial</option>'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2 " id="torres">'+' '+
                      '<div class="form-group">'+' '+
                        '<center><label >Tipo</label></center>'+' '+
                        '<select style="width:100%"  class="form-control tipo3" name="pu_final[tipo_pu][]" id="tipo3">'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center><label >Cantidad</label></center>'+' '+
                        '<input type="text" class="form-control cantidad3" placeholder= "Cantidad" name="pu_final[cantidad_pu][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 m2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center><label >m²</label></center>'+' '+
                        '<input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[metros_pu][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 kva">'+' '+
                      '<div class="form-group">'+' '+
                        '<center><label >KVA</label></center>'+' '+
                        '<input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[kva_pu][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 tblprod12" >'+' '+
                      '<div class="form-group">'+' '+
                        '<br>'+' '+
                        '<a class="btn btn-primary delete52" data-toggle="modal" href="#" id="delete52" style="background-color: #fdea08; border-color:#fdea08"><i class="glyphicon glyphicon-minus"></i></a>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                  '</div>'+' '+
                '</div>'
            );
                event.preventDefault();
                $("select").select2();

             });
             $(document).on("click",".delete52",function( event ) {
               $(this).closest("#quitar52").remove();
                  return false;
             });
          });

          // funcion encargada de manejar dinamicamente (eliminar y agregar campos) de el proceso de distribucion en la vista de alcances
          $(function() {
              var count = 1;
             $(document).on("click","#btnadd100",function( event ) {

              count++;
              $('#tblprod11').after(
                '<div class="row quitar51" id="quitar51">'+' '+
                  '<div class="col-md-12">'+' '+
                    '<div class="col-md-3">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Descripción</label></center>'+' '+
                        '<select style="width:100%" class="form-control desc2" name="distribucion[descripcion_dis][]" style="top:25px important!" id="desc">'+' '+
                          '<option value="">Seleccione...</option>'+' '+
                          '<option value="Inspección RETIE proceso de distribución en MT">Inspección RETIE proceso de distribución en MT</option>'+' '+
                          '<option value="Inspección RETIE proceso de distribución en BT">Inspección RETIE proceso de distribución en BT</option>'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Tipo</label></center>'+' '+
                        '<select style="width:100%" class="form-control tipo2 tipo"  name="distribucion[tipo_dis][]" id="tipo">'+' '+
                          '<option value="">Seleccione...</option>'+' '+
                          '<option value="Aérea">Tipo Aérea</option>'+' '+
                          '<option value="Subterránea">Tipo subterránea</option>'+' '+
                        '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Nivel de tensión (KV)  </label></center>'+' '+
                         '<select style="width:100%" class="form-control tipo2 tension4" name="distribucion[nivel_tension_dis][]" id="tension">'+' '+
                          '</select>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+

                    '<div class="col-md-2">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Longitud de red (mts.)</label></center>'+' '+
                        '<input type="text" class="form-control cantidad2" placeholder= "Cantidad" name="distribucion[cantidad_dis][]">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Apoyos o estructuras</label></center>'+' '+
                        '<input type="number" class="form-control apoyos" placeholder= "Cantidad" name="distribucion[apoyos_dis][]" id="apoyos">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1">'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"><label >Cajas de inspección</label></center>'+' '+
                        '<input type="number" class="form-control cajas" placeholder= "Cantidad" name="distribucion[cajas_dis][]" id="cajas">'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                    '<div class="col-md-1 tblprod11" >'+' '+
                      '<div class="form-group">'+' '+
                        '<center class="separar"></center>'+' '+
                        '<a class="btn btn-primary delete51" data-toggle="modal" id="delete51" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-minus"></i></a>'+' '+
                      '</div>'+' '+
                    '</div>'+' '+
                '</div>'+' '+
              '</div>'
            );
            if (tension == 0) {

            }
            else {
              $(".tension4").html('');
              $(".tension4").append('<option value="'+tension+'">'+tension+'</option>');
            }

                event.preventDefault();
                $("select").select2();
             });

             $(document).on("click",".delete51",function( event ) {
               $(this).closest("#quitar51").remove();
                  return false;
             });
          });




          // funcion encargada de manejar el tipo de cliente
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
        // select 2 para todos los selects
        $(document).ready(function(){
          $("select").select2();
        });



        // los sgtes eventos son los encargados de manejar matematicamente todos los calculos de impuestos operaciones y diferentes cosas que requiere
        // el modulo de administrativa
       $('.valor').keyup(function(){
           var valor = $(this).val().replace(/,/g,"");
           var resultado = valor * 1.19;
           var iva = valor*0.19;
           $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
           $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));


       });
          $('.valor_factura').keyup(function(){
              var valor = $(this).val().replace(/,/g,"");
              var resultado = valor * 1.19;
              var iva = valor*0.19;
              $(this).parent().parent().parent().find('.iva').val(addCommas2(Math.round(iva)));
              $(this).parent().parent().parent().find('.valor_total').val(addCommas2(Math.round(resultado)));

              var retencionesporcen = $(this).parent().parent().parent().find('.retencionesporcen').val().replace(/,/g,".");
              var valor2 = $(this).parent().parent().parent().find('.valor_factura').val().replace(/,/g,"");
              var resultado2 = valor2*retencionesporcen/100;
              $(this).parent().parent().parent().find('.retenciones').val(addCommas2(Math.round(resultado2)));

              var retegarantiaporcen = $(this).parent().parent().parent().find('.retegarantiaporcen').val().replace(/,/g,".");
              var valor3 = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
              var resultado3 = valor3*retegarantiaporcen/100;
              $(this).parent().parent().parent().find('.retegarantia').val(addCommas2(Math.round(resultado3)));


              var retenciones = $(this).parent().parent().parent().find('.retenciones').val().replace(/,/g,"");
              var amortizacion = $(this).parent().parent().parent().find('.amortizacion').val().replace(/,/g,"");
              var polizas = $(this).parent().parent().parent().find('.polizas').val().replace(/,/g,"");
              var retegarantia = $(this).parent().parent().parent().find('.retegarantia').val().replace(/,/g,"");
              var valor_total = $(this).parent().parent().parent().find('.valor_total').val().replace(/,/g,"");
              var resultado4 =valor_total-(parseFloat(retenciones)+parseFloat(amortizacion)+parseFloat(polizas)+parseFloat(retegarantia));
              $(this).parent().parent().parent().find('.valor_pagado').val(addCommas2(Math.round(resultado4)));



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
