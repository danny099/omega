@extends('index')

@section('scripts')
  <script type="text/javascript">
    function mascara(o,f){
  		v_obj=o;
  		v_fun=f;
  		setTimeout("execmascara()",1);
  	}
  	function execmascara(){
  		v_obj.value=v_fun(v_obj.value);
  	}
  	function cpf(v){
  		v=v.replace(/([^0-9\.]+)/g,'');
  		v=v.replace(/^[\.]/,'');
  		v=v.replace(/[\.][\.]/g,'');
  		v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2');
  		v=v.replace(/\.(\d{1,2})\./g,'.$1');
  		v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');
  		v = v.split('').reverse().join('').replace(/^[\,]/,'');
  		return v;
  	}
  	function calcular(){
  		var varMonto;
  		var varIva;
  		var varSubTotal;

  		varMonto = document.getElementById("antesiva").value;
  		varMonto = varMonto.replace(/[\,]/g,'');

  		varIva = parseFloat(varMonto) * 0.16;
  		document.getElementById("iva").value = addCommas(Math.round(varIva)) ;

  		varSubTotal = parseFloat(varMonto) + parseFloat(varIva);
  		document.getElementById("otrosi").value = addCommas(Math.round(varSubTotal)) ;

  	}

  	function addCommas(nStr){
  		nStr += '';
  		x = nStr.split(',');
  		x1 = x[0];
  		x2 = x.length > 1 ? ',' + x[1] : '';
  		var rgx = /(\d+)(\d{3})/;
  		while (rgx.test(x1)) {
  			x1 = x1.replace(rgx, '$1' + ',' + '$2');
  		}
  		return x1 + x2;
  	}
  </script>
@endsection


@section('contenido')

<ol class="breadcrumb">
  <li><a href="{{ url('index') }}">Inicio</a></li>
  <li class="active">Crear otro sí</li>
</ol>

  <form class="" action="{{ url('otrosi') }}" method="post" autocomplete="off">
    {{ csrf_field() }}
    <div class="container">
      <div class="box box-primary">
        <div class="box-header with-borde">
          <center> <h3>Agregar Otro sí</h3> </center>
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
        <div class="">
          <div class="box-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label >Código Proyecto</label>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="col-md-4">
                      <select class="form-control select2" name="administrativa_id" style="width: 100%" id="select" required="">
                        <option value="">Seleccione...</option>
                        @foreach($codigos as $codigo)
                        <option value="{{ $codigo->id }}">{{$codigo->codigo_proyecto}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                    <label >Valor otro sí antes de IVA</label>
                  </div>
                  <div class="form-group ">
                    <div class="col-md-4">
                      <input type="text" class="form-control antesiva" id="antesiva" placeholder= "Ingrese valor" name="valor"   onkeyup="calcular();"  onkeypress="mascara(this,cpf)"  onpaste="return false">
                    </div>
                    <div class="col-md-4" >

                    </div>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      <label >IVA</label>
                    </div>
                    <div class="form-group ">
                      <div class="col-md-4">
                        <input type="text" class="form-control iva" id="iva" readonly placeholder= "Valor" name="iva"  >
                      </div>
                      <div class="col-md-4" >

                      </div>
                    </div>
                  </div>
                </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <label >Valor total otro sí</label>
                      </div>
                      <div class="form-group ">
                        <div class="col-md-4">
                          <input type="text" class="form-control otrosi" id="otrosi" readonly  placeholder= "Valor" name="valor_tot">
                        </div>
                        <div class="col-md-4" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <label >Detalles</label>
                      </div>
                      <div class="form-group ">
                        <div class="col-md-4">
                          <input type="text" class="form-control" id="detalles"   placeholder= "Ingrese detalle" name="detalles" >
                        </div>
                        <div class="col-md-4" >
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                        <label>Recordarme</label>
                      </div>
                      <div class="col-md-6">
                        <label class="radio-inline">
                          <input type="radio" name="recuerdame" value="1" required > Si
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="recuerdame" value="0"> No
                        </label>
                      </div>
                      <div class="col-md-2" id="tblprod7">
                      </div>
                    </div>
                  </div>
              <button type="submit" class="btn btn-primary pull-right" style="background-color: #33579A; border-color:#33579A;">
                Guardar
              </button>
            </div>
          </div>
        </div>
    </div>
  </form>
@endsection
