<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">

    <style media="screen">

      body{
        font-size: 14px;
        text-align: justify;
      }
      p{
        margin: 0;
        padding: 0;
      }
      .codigo{
        display: inline-block;
        float: left;
        text-align: center;
      }
      .entrada{
        display: inline-block;
      }
      .obj1{
        display: inline-block;
        }
      .obj2{
        display: inline-block;
        margin-left: 150px;
        margin-right: 80px;
      }
      .cordial{
        border: black 1px solid;
      }
      .inspeccionDoc{
        border: black 1px solid;

      }
      .tx1{
        margin: 5px;
      }
      img{
        margin: 0;
      }
      .div2{
        padding: 0;
        margin-top: 50px;
      }
      .ttable{
        text-align: center;
      }
      #td{
        border-bottom: solid white;
      }
      #td2{
        border-top: solid white;
      }
      #td3{
        border-top: solid white;
      }
      table {
        border-collapse:collapse; border: none;
      }
      td {
        padding: 0;
      }
    </style>
  </head>
  <body>

    <img id="img" src="Certicol2.png" style="height:100px;">
    <br>
    <br>
    <div class="div1">
      <div class="entrada">
        <p>Santiago de Cali</p>
        <p>{{ date_format(new DateTime($cotizaciones->fecha), 'd-m-y') }}</p>

      </div>
      <div class="codigo">
        <table class="" align="right">
          <tr>
            <td colspan="2">Código de Cotización</td>
          </tr>
          <tr>
            <td>COT-2017</td>
            <td>A-109</td>
          </tr>
        </table>
      </div>
      <br>
      <br>
      <div class="dirigido">
        <p>{{ $cotizaciones->dirigido }}</p>
        @if(empty($clientes))
          <span>{{ $juridicas->razon_social }}</span>
        @else
          <span>{{ $clientes->nombre}}</span>
        @endif
      </div>
    </div>
    <div class="div2">
      <p class="obj1">
        Objeto:
      </p>
      <p class="obj2" align="justify">
        Este Documento Constitye la Oferta Tecnica y Economica para la prestación de servicios
        de inspectoria RETIE a las instalaciones electricas del proyecto {{ $cotizaciones->nombre }} Ubicado
        en el Municipio de {{ $municipios->nombre }} departamento del {{ $departamentos->nombre }}.
      </p>
    </div>
      <br>

    <div class="div3">
      <p>Cordial Saludo:</p>
      <br>
      <div class="cordial">
          <?php
            $refer = html_entity_decode($saludo->detalles);
            echo $refer;
          ?>
      </div>
    </div>
      <br>
      <br>
    <div class="alcances">
      <p><b>1. ALCANCE DE LA INSPECCIÓN</b></p>
          <br>
      @if(count($transformaciones) == 0)
      @else

      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="7" class="ttable">ALCANCE DE TRANSFORMACIÓN</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Nivel de Tensión</th>
            <th>Unidad</th>
            <th>Capacidad</th>
            <th>Cantidad</th>
            <th>Tipo de Refrigeración</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transformaciones as $transfor)
            <tr>
              <td>{{ $transfor->descripcion }}</td>
              <td>{{ $transfor->tipo }}</td>
              <td>{{ $transfor->nivel_tension }}</td>
              <td>{{ $transfor->unidad }}</td>
              <td>{{ $transfor->capacidad }}</td>
              <td>{{ $transfor->cantidad }}</td>
              <td>{{ $transfor->tipo_refrigeracion }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      @endif

      @if(count($distribuciones) == 0)
      @else
      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="8" class="ttable">ALCANCE DE DISTRIBUCIÓN</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Nivel de Tensión</th>
            <th>Unidad</th>
            <th>Cantidad</th>
            <th>Apoyos</th>
            <th>Cajas</th>
            <th>Notas</th>
          </tr>
        </thead>
        <tbody>
          @foreach($distribuciones as $distri)
            <tr>
              <td>{{ $distri->descripcion }}</td>
              <td>{{ $distri->tipo }}</td>
              <td>{{ $distri->nivel_tension }}</td>
              <td>{{ $distri->unidad }}</td>
              <td>{{ $distri->cantidad }}</td>
              <td>{{ $distri->apoyos }}</td>
              <td>{{ $distri->cajas }}</td>
              <td>{{ $distri->notas }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <br>
      @endif

      @if(count($pu_finales) == 0)
      @else
      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="8" class="ttable">ALCANCE PROCESO USO FINAL</th>
        </tr>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Estrato</th>
            <th>Unidad</th>
            <th>Cantidad</th>
            <th>Metros</th>
            <th>Kva</th>
            <th>Acometidas</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pu_finales as $pu)
            <tr>
              <td>{{ $pu->descripcion }}</td>
              <td>{{ $pu->tipo }}</td>
              <td>{{ $pu->estrato }}</td>
              <td>{{ $pu->unidad }}</td>
              <td>{{ $pu->cantidad }}</td>
              <td>{{ $pu->metros }}</td>
              <td>{{ $pu->kva }}</td>
              <td>{{ $pu->acometidas }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>

    <div class="asociados">
      <table class="table table-bordered tabla">
        @if(count($transformaciones) == 0)
        @else
          <tr>
            <td ><p>Transformación asociado a Uso Final</p></td>
            <td><p><b>Descripción</b></p></td>
            <td><p><b>Valor</b></p></td>
          </tr>
          @foreach($transformaciones as $transf)
          <tr>
            <td id="td3"></td>
            <td><p>Nivel de Tensión (KV)</p></td>
            <td><p>{{ $transf->nivel_tension }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Número de Transformadores</p></td>
            <td><p>{{ $transf->cantidad }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Potencia</p></td>
            <td><p>{{ $transf->capacidad }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Montaje</p></td>
            <td><p>{{ $transf->tipo }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Tipo de Refrigeración</p></td>
            <td><p>{{ $transf->tipo_refrigeracion }}</p></td>
          </tr>
          @endforeach
        @endif

        @if(count($distribuciones) == 0)
        @else
          <tr>
            <td ><p>Distribución asociado a Uso Final</p></td>
            <td><p><b>Descripción</b></p></td>
            <td><p><b>Valor</b></p></td>
          </tr>
          @foreach($distribuciones as $distris)
          <tr>
            <td id="td3"></td>
            <td><p>Descripcion</p></td>
            <td><p>{{  $distris->descripcion }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Tipo de Red</p></td>
            <td><p>{{ $distris->tipo }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Nivel de Tensión</p></td>
            <td><p>{{ $distris->nivel_tension }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Longitu de Red</p></td>
            <td><p>{{ $distris->cantidad }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Numero de Apoyos o Estructuras</p></td>
            <td><p>{{ $distris->apoyos }}</p></td>
          </tr>
          <tr>
            <td id="td3"></td>
            <td><p>Numero de Cajas de Inspección</p></td>
            <td><p>{{ $distris->cajas }}</p></td>
          </tr>
          @endforeach
        @endif
      </table>
    </div>
    <p><b>{{$referencia->nombre}}</b></p>
    <br><br>
    <div class="referencia">
      <?php
        $refer = html_entity_decode($referencia->detalles);
        echo $refer;
      ?>

    </div>
    <br>
    <br>
    <p><b>{{$inicial->nombre}}</b></p>

    <br><br>
    <div class="inspeccionDoc">
      <?php
        $refer = html_entity_decode($inicial->detalles);
        echo $refer;
      ?>
    </div>
    <br>
    <br>
    <p><b>{{$inspeccion->nombre}}</b></p>
    <div class="inscricion">
      <?php
        $refer = html_entity_decode($inspeccion->detalles);
        echo $refer;
      ?>
    </div>
    <br>
    <br>
    <div class="referencia">
      <p><b>5. PROPUESTA ECONOMICA</b></p>


      <table class="table table-bordered tabla">
        <tr>
          <th Colspan="4"><center><label> Cotización</label></center></th>
        </tr>
        <tr>
          <th><center><label> Item </label></center></th>
          <th><center><label> Descripcion del alcance </label></center></th>
          <th><center><label> Cantidad </label></center></th>
          <th><center><label> Valor </label></center></th>
        </tr>
        @foreach($transformaciones as $trans)
          <tr>
            <td>1</td>
            <td>
              <p>{{ $trans->descripcion }} {{ $trans->tipo }}, Capacidad: {{ $trans->capacidad}} + Sistema de Puesta a Tierra</p>
            </td>
            <td>{{ $trans->cantidad }} {{ $trans->unidad }}</td>

            <td id="td"></td>
          </tr>
        @endforeach
        @foreach($distribuciones as $distri)
          <tr>
            <td>1</td>
            <td>
              <p>{{ $distri->descripcion }} {{ $distri->tipo }}</p>
            </td>
            <td>{{ $distri->cantidad }} {{ $distri->unidad }}</td>

            <td id="td2"></td>
          </tr>
        @endforeach
        <tr>
          <td></td>
          <td colspan="2">Valor de la Inspección</td>
          <td>${{ number_format($total,0) }}</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">IVA(19%)</td>
          <td>${{ number_format($iva,0) }}</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">Valor Total del Proyecto</td>
          <td>${{ number_format($valor_total,0) }}</td>
        </tr>
        <!-- <td>
          <p> </p>
          @foreach($pu_finales as $pu)
          <p>{{ $pu->descripcion }} - {{ $pu->tipo }} +</p>
          @endforeach
          <p>Unidades de Vivienda</p>
        </td> -->

      </table>
    </div>
    <div class="comerciales">
      <p><b>6. CONDICIONES COMERCIALES</b></p>

      <table class="table table-bordered tabla">
        <tr>
          <td>Forma de pago</td>
          <td>{{$cotizaciones->formas_pago}}</td>
        </tr>
        <tr>
          <td>Tiempo de ejecución</td>
          <td>{{$cotizaciones->tiempo}}</td>
        </tr>
        <tr>
          <td>Tiempo de entrega del dictamen</td>
          <td>{{$cotizaciones->entrega}} una vez se encuentre la documentacion completa y no se tenga NC abiertas</td>
        </tr>
        <tr>
          <td>Número de visitas de inspeccion contratadas</td>
          <td>{{$cotizaciones->visitas}} </td>
        </tr>
        <tr>
          <td>Validez de la oferta</td>
          <td>{{$cotizaciones->validez}} </td>
        </tr>
      </table>
    </div>
    <div class="pago">
      <p><b>{{$pago->nombre}}</b></p>
      <?php
        $refer = html_entity_decode($pago->detalles);
        echo $refer;
      ?>
    </div>
    <div class="docu">
      <p><b>{{$docu->nombre}}</b></p>
      <?php
        $refer = html_entity_decode($docu->detalles);
        echo $refer;
      ?>
    </div>
    <div class="img">
      <img id="img" src="firma.jpg" style="height:80px;">
      <img id="img" src="Certicol2.png" style="margin-left:250px; height:80px">
    </div>
    <div class="datos">
      <?php
        $refer = html_entity_decode($datos->detalles);
        echo $refer;
      ?>
    </div>
  </body>
</html>
