@extends('index')

@section('contenido')
<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li><a href="{{ url('administrativas')}}">Administrativa</a></li>
  <li class="active">Editar Proyecto</li>
</ol>
<div class="box box-primary">
  <div class="box-header with-border">
    <center> <h3 class="box-title">Datos del proyecto</h3></center>
    <div class="">
      <a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary  pull-right">P</a>
      <a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary  pull-right">D</a>
      <a href="{{ route('transformaciones.edit', $administrativas->id) }}" class="btn btn-primary  pull-right">T</a>


    </div>
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
  {!! Form::model($administrativas, ['method' => 'PATCH', 'action' => ['AdministrativaController@update',$administrativas->id]]) !!}
  {{ csrf_field() }}

    <div class="box-body">
      <div class="col-md-4">

          <div class="form-group">
            {!! Form::label('codigo_proyecto', 'Codigo del proyecto:') !!}
            {!! Form::text('codigo_proyecto', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('nombre', 'Nombre del proyecto') !!}
            {!! Form::text('nombre_proyecto', null, ['class' => 'form-control' , 'required' => 'required']) !!}
          </div>

        <div class="form-group">
          {!! Form::label('fecha_contrato', 'Fecha del contrato:') !!}
          {!! Form::date('fecha_contrato', null, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>


      @if(empty($administrativas->juridica->id ))
        <div class="form-group" >
          <label >Tipo cliente</label>
          <select class="form-control" name="cliente_id" id="cliente" required="">

            <option value="1">Persona natural</option>
            <option value="2">Persona juridica</option>
          </select>
        </div>
        <div class="form-group"  id="natural">
          <label >Persona natural</label>
          <select class="form-control select2" name="cliente_id" style="width: 100%" id="select-natural">
            <option value="{{ $administrativas->cliente->id }}">{{ $administrativas->cliente->nombre }}</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group" style="Display:none" id="juridica">
          <label >Persona juridica</label>
          <select class="form-control" name="juridica_id" >
            <option value="">Seleccione</option>
            @foreach($juridicas as $juridica)
            <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
            @endforeach
          </select>
        </div>
      @endif
      @if(empty($administrativas->cliente->id ))
      <div class="form-group" >
        <label >Tipo cliente</label>
        <select class="form-control" name="cliente_id" id="cliente" required="">
          <option value="2">Persona juridica</option>
          <option value="1">Persona natural</option>
        </select>
      </div>
      <div class="form-group" style="Display:none" id="natural">
        <label >Persona natural</label>
        <select class="form-control select2" style="Display:none" name="cliente_id" style="width: 100%" id="select-natural">
          <option value="">Seleccione</option>
          @foreach($clientes as $cliente)
          <option value="{{ $cliente->id }}">{{$cliente->nombre}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group"  id="juridica">
        <label >Persona juridica</label>
        <select class="form-control" name="juridica_id" >
          <option value="{{ $administrativas->juridica->id }}">{{ $administrativas->juridica->razon_social }}</option>
          @foreach($juridicas as $juridica)
          <option value="{{ $juridica->id }}">{{$juridica->razon_social}}</option>
          @endforeach
        </select>
      </div>
      @endif



      </div>

      <div class="col-md-4">

        <div class="form-group">
          <label >Departamento</label>
            <select class="form-control" name="departamento" id="departamento">
              <option value="{{ $administrativas->departamento->nombre }}">{{ $administrativas->departamento->nombre }}</option>
              @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}">{{$departamento->nombre}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
          <label >Municipios</label>
            <select class="form-control" name="municipio" id="municipio">
              <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
              <option value=""></option>
            </select>
        </div>
        <div class="form-group">
          <label >Tipo de zona</label>
          <select class="form-control" name="zona">
            <option value="{{ $administrativas->tipo_zona }}">{{ $administrativas->tipo_zona }}</option>
            <option value="Urbana">Urbana</option>
            <option value="Rural">Rural</option>
          </select>
        </div>
        <div class="form-group">
          {!! Form::label('valor_contrato_inicial', 'Valor antes del iva') !!}
          {!! Form::number('valor_contrato_inicial', $administrativas->valor_contrato_inicial, ['class' => 'form-control' , 'required' => 'required']) !!}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label >Valor iva</label>
          <input type="number" class="form-control" id="iva" readonly="readonly" placeholder= "valor iva" name="iva" value="">
        </div>

        <div class="form-group ">
          <!-- @if(count($adicionales) == 0)
        <label >Valor adicional</label>
            <div class="col-md-11" >
              <input type="number" class="form-control" id="adicional" placeholder= "Ingrese valor" name="adicional[]"  onkeyup="sumar()" value="">
              <label >detalle valor adicional</label>
              <input type="text" class="form-control" id="detalle" placeholder= "Ingrese detalle" name="detalle[]" value="">
            </div>

            <div class="col-md-1" id="tblprod5">
              <a class="btn btn-warning" id="btnadd5" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
          @else
          <label >Valor adicional</label>
            @foreach($adicionales as $adicional)
              <div class="col-md-11" >

                <input type="number" class="form-control" id="adicional" placeholder= "Ingrese valor" name="adicional[]"  onkeyup="sumar()" value="{{ $adicional->valor}}">
                <label >detalle valor adicional</label>
                <input type="text" class="form-control" id="detalle" placeholder= "Ingrese detalle" name="detalle[]" value="{{ $adicional->detalle}}">
              </div>

              <div class="col-md-1" id="tblprod5">
                <a class="btn btn-warning" id="btnadd5" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            @endforeach
          @endif -->

        <!-- <div class="form-group ">

          @if(count($otrosis) == 0)
        <label >Otro si</label>
            <div class="col-md-11" >

              <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar()" value="">
            </div>

            <div class="col-md-1" id="tblprod">
              <a class="btn btn-warning" id="btnadd" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
          @else
            <label >Otro si</label>
            @foreach($otrosis as $otro)
              <div class="col-md-11" >
                <input type="number" class="form-control" id="otrosi[]" placeholder= "Ingrese valor" name="otrosi[]"  onkeyup="sumar()" value="{{ $otro->valor}}">
              </div>

              <div class="col-md-1" id="tblprod">
                <a class="btn btn-warning" id="btnadd" data-toggle="modal" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            @endforeach
          @endif -->

          <div class="form-group">
            <br>
            <br>
            <label >Valor contrato final</label>
            <input type="number" class="form-control" id="fin" readonly="readonly" placeholder= "Valor final" name="contrato_final" value="{{ $administrativas->valor_contrato_final}}">
          </div>

          <div class="form-group">
            <label >Plan de pago</label>
            <input type="text" class="form-control" placeholder= "Ingrese valor" name="plan_pago" value="{{ $administrativas->plan_pago}}">
          </div>
        </div>
      </div>


      <hr>

    </div>
</div>
<!-- ************************************************************************************************************* -->

<!-- <div class="box box-primary">
    <div class="box-header with-border">
      <center> <h3 class="box-title">Alcance: proceso de transformacion</h3> </center>
    </div>

    <div class="box-body">
        @if(count($transformaciones) == 0)
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
                  <input style="text-align:center;" type="text" class="form-control" value=""  readonly=”readonly” name="transformacion[unidad_transformacion][]">
                </center>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <center><label >Cantidad</label></center>
                <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]" value="">
              </div>
            </div>

            <div class="col-md-1" id="tblprod2">
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
          </div>
        @else
          @foreach($transformaciones as $transfor)
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="form-group">
                  <center><label >Descripcion</label></center>
                  <input type="text" class="form-control" value="{{ $transfor->descripcion }}"  readonly=”readonly” name="transformacion[descripcion][]">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <center><label >Tipo</label></center>
                  <select class="form-control" name="transformacion[tipo][]">
                    <option value="{{ $transfor->tipo }}">{{ $transfor->tipo }}</option>
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
                    <option value="{{ $transfor->capacidad }}">{{ $transfor->capacidad }}</option>
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
                    <input style="text-align:center;" type="text" class="form-control" value="{{ $transfor->unidad }}"  readonly=”readonly” name="transformacion[unidad_transformacion][]">
                  </center>
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <center><label >Cantidad</label></center>
                  <input type="text" class="form-control" placeholder= "Cantidad" name="transformacion[cantidad][]" value="{{ $transfor->cantidad }}">
                </div>
              </div>

              <div class="col-md-1" id="tblprod2">
                <div class="form-group">
                  <br>
                  <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd2" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
              </div>
            </div>
          @endforeach
        @endif


        @if(count($distribuciones) == 0)
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
              <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]" value="">
            </div>
          </div>

          <div class="col-md-1" id="tblprod3">
            <div class="form-group">
              <br>
              <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
          </div>
        @else
          @foreach($distribuciones as $distribucion)
            <div class="col-md-12">
              <center> <h4 class="box-title">Alcance: proceso de distribucion</h4> </center>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Descripcion</label></center>
                <select class="form-control" name="distribucion[descripcion_dis][]">
                  <option value="{{ $distribucion->descripcion }}">{{ $distribucion->descripcion }}</option>
                  <option value="Inspeccion retie proceso de distribucion en MT">Inspeccion retie proceso de distribucion en MT</option>
                  <option value="Inspeccion retie proceso de distribucion en BT">Inspeccion retie proceso de distribucion en BT</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Tipo</label></center>
                <select class="form-control" name="distribucion[tipo_dis][]">
                  <option value="{{ $distribucion->descripcion }}">{{ $distribucion->descripcion }}</option>
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
                <input type="text" class="form-control" placeholder= "Cantidad" name="distribucion[cantidad_dis][]" value="{{ $distribucion->cantidad }}">
              </div>
            </div>

            <div class="col-md-1" id="tblprod3">
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" id="btnadd3" href="#" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
          @endforeach
        @endif



        @if(count($pu_finales) == 0)
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
              <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]" value="">
            </div>
          </div>

          <div class="col-md-1" id="tblprod4">
            <div class="form-group">
              <br>
              <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd4" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
            </div>
          </div>
        @else
          @foreach($pu_finales as $pu)
            <div class="col-md-12">
              <center> <h4 class="box-title">Alcance: proceso de uso final</h4> </center>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <center><label >Descripcion</label></center>
                <select class="form-control"name="pu_final[descripcion_pu][]">
                  <option value="{{ $pu->descripcion }}">{{ $pu->descripcion }}</option>
                  <option value="Inspeccion retie proceso uso final residencial">Inspeccion retie proceso uso final residencial</option>
                  <option value="Inspeccion retie proceso uso final comercial">Inspeccion retie proceso uso final comercial</option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <center><label >Tipo</label></center>
                <select class="form-control" name="pu_final[tipo_pu][]">
                  <option value="{{ $pu->tipo }}">{{ $pu->tipo }}</option>
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
                <input type="text" class="form-control" placeholder= "Cantidad" name="pu_final[cantidad_pu][]" value="{{ $pu->cantidad }}">
              </div>
            </div>
            <div class="col-md-1" id="tblprod4">
              <div class="form-group">
                <br>
                <a class="btn btn-primary" data-toggle="modal" href="#" id="btnadd4" style="background-color: #fdea08; border-color:#fdea08;"><i class="glyphicon glyphicon-plus"></i></a>
              </div>
            </div>
          @endforeach
        @endif -->
      <div class="col-md-12">
        <center> <h4 class="box-title">Observaciones de estado administrativo del proyecto</h4> </center>
      </div>

      <div class="col-md-12">
        <textarea  rows="4" cols="196" name="resumen"></textarea>
      </div>
    </div>
      <div class="box-footer">
        <button type="submit" data-target="" data-toggle="" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">Agregar</button>
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
@endsection
