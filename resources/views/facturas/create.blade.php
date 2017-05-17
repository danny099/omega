<div class="container">
   <div class="">
     <div class="">
       <h3 class="box-title">Crear Facturas</h3>
     </div>


     <!-- /.box-header -->
     <!-- form start -->
       {!! Form::open(['class'=>'form1','url' => 'facturas']) !!}
       {{ csrf_field() }}
       <div class="box-body col-md-6">
         <br>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('fecha_factura', 'Fecha de la factura') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_factura', 'Valor factura antes de iva') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('valor_factura', null, ['class' => 'form-control valor_factura' , 'onKeyUp' => 'Suma()','required' => 'required', 'min'=>'0']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('iva', 'IVA') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('iva', null, ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_total', 'Valor total de la factura') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('retenciones', 'Retenciones %') !!}
             {!! Form::label('retenciones2', 'Retenciones valor') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('retencionesporcen', 0, ['class' => 'form-control retencionesporcen', 'min'=>'0']) !!}
             {!! Form::number('retenciones', 0, ['class' => 'form-control retenciones', 'min'=>'0','readonly']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('amortizacion', 'Amortizacion%:') !!}
             {!! Form::label('amortizacion2', 'Amortizacion valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('amortizacionporcen', 0, ['class' => 'form-control amortizacionporcen', 'min'=>'0']) !!}
             {!! Form::number('amortizacion', 0, ['class' => 'form-control amortizacion', 'min'=>'0','readonly']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('polizas', 'Polizas%:') !!}<br>
             {!! Form::label('polizas2', 'Polizas valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('polizasporcen', 0, ['class' => 'form-control polizasporcen','min'=>'0' ]) !!}
             {!! Form::number('polizas', 0, ['class' => 'form-control polizas','min'=>'0','readonly' ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('retegarantia', 'Retegarantia%:') !!}
             {!! Form::label('retegarantia2', 'Retegarantia valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('retegarantiaporcen', 0, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]) !!}
             {!! Form::number('retegarantia', 0, ['class' => 'form-control retegarantia', 'min'=>'0','readonly' ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_pagado', 'Valor pagado:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('valor_pagado', 0, ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
               {!! Form::label('observaciones', 'Observaciones:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('observaciones', null, ['class' => 'form-control' ]) !!}
           </div>
         </div>


           <input type="hidden" name="administrativa_id" value="{{ $administrativa->id }}">
           <div class="box-footer">
             <button type="submit" class="btn btn-primary pull-right">Enviar</button>
             <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left">Cancelar</button>
           </div>
       </div>
       <!-- /.box-body -->
     {!! Form::close() !!}
   </div>
 </div>

 <script type="text/javascript">
     function Suma() {
       var ingreso1 = $('.valor_factura').val();
       var resultado = ingreso1 * 1.19;
       var iva = ingreso1 * 0.19;
       try{
         $('.iva').val(iva);
         $('.valor_total').val(resultado);
       }
     //Si se produce un error no hacemos nada
       catch(e) {}
     }
 </script>
