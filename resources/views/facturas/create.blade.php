<div class="container">
   <div class="">
     <div class="">
       <h3 >Crear Facturas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Saldo: ${{ number_format($administrativa->saldo,0) }}</h3>

     </div>


     <!-- /.box-header -->
     <!-- form start -->
       {!! Form::open(['url' => 'facturas', 'autocomplete'=>"off"]) !!}
       {{ csrf_field() }}
       <div class="box-body col-md-6">
         <br>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('codigo_factura', 'Número de la factura') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::number('num_factura', null, ['class' => 'form-control' , 'required' => 'required']) !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('fecha_factura', 'Fecha de la factura') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::date('fecha_factura', null, ['class' => 'form-control' , 'required' => 'required', 'style'=>'width:110%']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_factura', 'Valor factura antes de IVA') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('valor_factura', null, ['class' => 'form-control valor_factura' ,'required' => 'required', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('iva', 'IVA') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('iva', null, ['class' => 'form-control iva' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_total', 'Valor total de la factura') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('valor_total', null, ['class' => 'form-control valor_total' ,'readonly', 'required' => 'required', 'min'=>'0']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('rete_porcen', 'Retenciones %') !!}
             {!! Form::label('retenciones', 'Retenciones valor') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('rete_porcen', 0, ['class' => 'form-control retencionesporcen', 'min'=>'0']) !!}
             {!! Form::text('retenciones', 0, ['class' => 'form-control retenciones', 'min'=>'0','readonly']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('amortizacion2', 'Amortización valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('amortizacion', 0, ['class' => 'form-control amortizacion', 'min'=>'0','onkeyup'=>"mascara(this,cpf)"]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('polizas', 'Pólizas valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('polizas', 0, ['class' => 'form-control polizas','min'=>'0','onkeyup'=>"mascara(this,cpf)" ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('retegaran_porcen', 'Retegarantía%:') !!}
             {!! Form::label('retegarantia', 'Retegarantía valor:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('retegaran_porcen', 0, ['class' => 'form-control retegarantiaporcen', 'min'=>'0' ]) !!}
             {!! Form::text('retegarantia', 0, ['class' => 'form-control retegarantia', 'min'=>'0','readonly' ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('valor_pagado', 'Valor pagado:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('valor_pagado', 0, ['class' => 'form-control valor_pagado', 'min'=>'0','readonly' ]) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
             {!! Form::label('fecha_pago', 'Fecha Pago:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::date('fecha_pago', null, ['class' => 'form-control' , 'required' => 'required', 'style'=>'width:110%']) !!}
           </div>
         </div>

         <div class="col-md-6">
           <div class="form-group">
               {!! Form::label('observaciones', 'Observaciones:') !!}
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             {!! Form::text('observaciones', null, ['class' => 'form-control', 'required' => 'required' ]) !!}
           </div>
         </div>
         <div class="col-md-6" style="height:40px">
           <div class="form-group">
              <center><label>Recordarme</label></center>
           </div>
         </div>
         <div class="col-md-6" style="height:40px">
           <label class="radio-inline">
             <input type="radio" name="recuerdame" value="1" required > Si
           </label>
           <label class="radio-inline">
             <input type="radio" name="recuerdame" value="0"> No
           </label>
         </div>


           <input type="hidden" name="administrativa_id" value="{{ $administrativa->id }}">
           <div class="box-footer">
             <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Enviar</button>
             <button type="submit" data-dismiss="modal" class="btn btn-primary pull-left" style="background-color: #33579A; border-color:#33579A;">Cancelar</button>
           </div>
       </div>
       <!-- /.box-body -->
     {!! Form::close() !!}
   </div>
 </div>
