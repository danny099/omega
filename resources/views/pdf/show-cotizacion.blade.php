<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $cotizaciones->codigo }} - {{ $cotizaciones->nombre }}</title>
    <style media="screen">
    table {
      background-color: transparent;
    }
    caption {
      padding-top: 8px;
      padding-bottom: 8px;
      color: #777;
      text-align: left;
    }
    th {
      text-align: left;
    }
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 3px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
      vertical-align: bottom;
      border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #ddd;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }
    .table-bordered {
      border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
      border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
      border-bottom-width: 2px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #f9f9f9;
    }
    .table-hover > tbody > tr:hover {
      background-color: #f5f5f5;
    }
    table col[class*="col-"] {
      position: static;
      display: table-column;
      float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
      position: static;
      display: table-cell;
      float: none;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
      background-color: #f5f5f5;
    }
    .table-hover > tbody > tr > td.active:hover,
    .table-hover > tbody > tr > th.active:hover,
    .table-hover > tbody > tr.active:hover > td,
    .table-hover > tbody > tr:hover > .active,
    .table-hover > tbody > tr.active:hover > th {
      background-color: #e8e8e8;
    }
    .table > thead > tr > td.success,
    .table > tbody > tr > td.success,
    .table > tfoot > tr > td.success,
    .table > thead > tr > th.success,
    .table > tbody > tr > th.success,
    .table > tfoot > tr > th.success,
    .table > thead > tr.success > td,
    .table > tbody > tr.success > td,
    .table > tfoot > tr.success > td,
    .table > thead > tr.success > th,
    .table > tbody > tr.success > th,
    .table > tfoot > tr.success > th {
      background-color: #dff0d8;
    }
    .table-hover > tbody > tr > td.success:hover,
    .table-hover > tbody > tr > th.success:hover,
    .table-hover > tbody > tr.success:hover > td,
    .table-hover > tbody > tr:hover > .success,
    .table-hover > tbody > tr.success:hover > th {
      background-color: #d0e9c6;
    }
    .table > thead > tr > td.info,
    .table > tbody > tr > td.info,
    .table > tfoot > tr > td.info,
    .table > thead > tr > th.info,
    .table > tbody > tr > th.info,
    .table > tfoot > tr > th.info,
    .table > thead > tr.info > td,
    .table > tbody > tr.info > td,
    .table > tfoot > tr.info > td,
    .table > thead > tr.info > th,
    .table > tbody > tr.info > th,
    .table > tfoot > tr.info > th {
      background-color: #d9edf7;
    }
    .table-hover > tbody > tr > td.info:hover,
    .table-hover > tbody > tr > th.info:hover,
    .table-hover > tbody > tr.info:hover > td,
    .table-hover > tbody > tr:hover > .info,
    .table-hover > tbody > tr.info:hover > th {
      background-color: #c4e3f3;
    }
    .table > thead > tr > td.warning,
    .table > tbody > tr > td.warning,
    .table > tfoot > tr > td.warning,
    .table > thead > tr > th.warning,
    .table > tbody > tr > th.warning,
    .table > tfoot > tr > th.warning,
    .table > thead > tr.warning > td,
    .table > tbody > tr.warning > td,
    .table > tfoot > tr.warning > td,
    .table > thead > tr.warning > th,
    .table > tbody > tr.warning > th,
    .table > tfoot > tr.warning > th {
      background-color: #fcf8e3;
    }
    .table-hover > tbody > tr > td.warning:hover,
    .table-hover > tbody > tr > th.warning:hover,
    .table-hover > tbody > tr.warning:hover > td,
    .table-hover > tbody > tr:hover > .warning,
    .table-hover > tbody > tr.warning:hover > th {
      background-color: #faf2cc;
    }
    .table > thead > tr > td.danger,
    .table > tbody > tr > td.danger,
    .table > tfoot > tr > td.danger,
    .table > thead > tr > th.danger,
    .table > tbody > tr > th.danger,
    .table > tfoot > tr > th.danger,
    .table > thead > tr.danger > td,
    .table > tbody > tr.danger > td,
    .table > tfoot > tr.danger > td,
    .table > thead > tr.danger > th,
    .table > tbody > tr.danger > th,
    .table > tfoot > tr.danger > th {
      background-color: #f2dede;
    }
    .table-hover > tbody > tr > td.danger:hover,
    .table-hover > tbody > tr > th.danger:hover,
    .table-hover > tbody > tr.danger:hover > td,
    .table-hover > tbody > tr:hover > .danger,
    .table-hover > tbody > tr.danger:hover > th {
      background-color: #ebcccc;
    }
    .table-responsive {
      min-height: .01%;
      overflow-x: auto;
    }
    @media screen and (max-width: 767px) {
      .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
      }
      .table-responsive > .table {
        margin-bottom: 0;
      }
      .table-responsive > .table > thead > tr > th,
      .table-responsive > .table > tbody > tr > th,
      .table-responsive > .table > tfoot > tr > th,
      .table-responsive > .table > thead > tr > td,
      .table-responsive > .table > tbody > tr > td,
      .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
      }
      .table-responsive > .table-bordered {
        border: 0;
      }
      .table-responsive > .table-bordered > thead > tr > th:first-child,
      .table-responsive > .table-bordered > tbody > tr > th:first-child,
      .table-responsive > .table-bordered > tfoot > tr > th:first-child,
      .table-responsive > .table-bordered > thead > tr > td:first-child,
      .table-responsive > .table-bordered > tbody > tr > td:first-child,
      .table-responsive > .table-bordered > tfoot > tr > td:first-child {
        border-left: 0;
      }
      .table-responsive > .table-bordered > thead > tr > th:last-child,
      .table-responsive > .table-bordered > tbody > tr > th:last-child,
      .table-responsive > .table-bordered > tfoot > tr > th:last-child,
      .table-responsive > .table-bordered > thead > tr > td:last-child,
      .table-responsive > .table-bordered > tbody > tr > td:last-child,
      .table-responsive > .table-bordered > tfoot > tr > td:last-child {
        border-right: 0;
      }
      .table-responsive > .table-bordered > tbody > tr:last-child > th,
      .table-responsive > .table-bordered > tfoot > tr:last-child > th,
      .table-responsive > .table-bordered > tbody > tr:last-child > td,
      .table-responsive > .table-bordered > tfoot > tr:last-child > td {
        border-bottom: 0;
      }
    }

      /*.referencia, .comerciales, .inspeccionDoc,.pago, .referencia, .ocho, .inscricion {
        page-break-inside: avoid;
      }*/
      body{
        font-family: "Arial Narrow",sans-serif;
      	font-size: 9pt;
      	font-style: normal;
      	font-variant: normal;
      	font-weight: 500;
      	line-height: 15.4px;
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
        display: block;
        float: left;
        margin-right: 5px;

        }
      .obj2{
        display: inline-block;
        margin-left: 10px;
        margin-right: 30px;
      }


      .tx1{
        margin: 5px;
      }
      img{
        margin: 0;
        padding: 0;
      }
      .div2{
        padding: 0;
        margin-top: 20px;
      }
      .ttable{
        text-align: center;
      }
      .inspeccionDoc{
      page-break-before: always;
      }
      /*#td{
        border-bottom: solid black;
      }
      #td2{
        border-top: solid white;
      }
      #td3{
        border-top: solid white;
      }*/
      table {
        border-collapse:collapse; border: none;
      }
      td {
        padding: 0;
      }

      .referencia {
          page-break-after: always;
      }
      .comerciales {
          page-break-after: avoid;
      }

      @page { margin: 100px 50px; }
      header { position: fixed; top: -60px; left: 0px; right: 0px; height: 100px;
            margin-top: 25px}
      footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
      .page-number:after {content: counter(page); }

      /*p { page-break-after: always; }*/
      /*p:last-child { page-break-after: never; }*/

    </style>
  </head>
  <body>

    <header>

      <table class="table table-bordered " cellpadding="0" cellspacing="0">
        <tr>
          <td width="100" heigth="100"><center><img id="img" src="logo.jpg" style="width:100px; opacity: 0.5;"></center></td>
          <th style="font-size:15pt; color:#808080;" width="300"><center>COTIZACIÓN</center></th>
          <td style="font-size:10pt; color:#808080; margin-top:50px;" valign="middle"><center><p class=""><script type="text/php">
            if ( isset($pdf) ) {
              $font = $fontMetrics->getFont('Arial Narrow');
              $pdf->page_text(490, 45, "Página: {PAGE_NUM} de {PAGE_COUNT}",$font, 8, array(0,0,0));
            }
        </script> </p></center></td>
        </tr>
      </table>
    </header>
    <footer>
      <table class="table">
        <tr>
          <td id="td3"><center><span class="">Certicol_for_096 / Aprobado 09-05-2017 / Versión 01 </span></center></td>
        </tr>
      </table>
    </footer>

    <div class="div1">
      <div class="entrada">
        <p>Santiago de Cali</p>
        <p>{{ date_format(new DateTime($cotizaciones->fecha), 'd-m-y') }}</p>

      </div>
      <div class="codigo">
        <table class=" " align="right">
          <tr>
            <td colspan="2">Código de Cotización</td>
          </tr>
          <tr>
            <td>{{$cotizaciones->codigo}}</td>

          </tr>
        </table>
      </div>

      <div class="dirigido">
        <p>{{ $cotizaciones->dirigido }}</p>
        @if(empty($clientes))
        <span>{{ $juridicas->nombre_representante }}</span><br>
        <span>{{ $juridicas->razon_social }}</span><br>
        <span>NIT: {{ $juridicas->nit }}</span><br>
        @else
        <span>{{ $clientes->nombre }}</span><br>
        <span>CC: {{ $clientes->cedula }}</span>
        @endif
      </div>
    </div>

    <div class="div2">
      <table>
       <tr>
         <td valign="top"> Objeto:</td>
         <td text-align="justify">Este Documento Constituye  la Oferta Técnica  y Económica  para la prestación de servicios
         de inspectoría  RETIE a las instalaciones eléctricas del proyecto {{ $cotizaciones->nombre }} Ubicado
         en el Municipio de {{ $municipios->nombre }} departamento del {{ $departamentos->nombre }}.</td>
       </tr>
     </table>
    </div>

    <br>
    <div class="div3">
      <p>Cordial Saludo:</p>

      <div class="cordial">
          <?php
            $refer = html_entity_decode($saludo->detalles);
            echo $refer;
          ?>
      </div>
    </div>
    <br>
    <div class="alcances">
      <p><b>1. ALCANCE DE LA INSPECCIÓN</b></p>

      @if(count($transformaciones) == 0)
      @else

      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="6" class="ttable">TRANSFORMACIÓN</th>
        </tr>
        <thead>
          <tr>
            <th><center>Descripción</center></th>
            <th width="50"><center>Tipo</center></th>
            <th width="60"><center>Tensión (KV)</center></th>
            <th width="50"><center>Capacidad(KVA)</center></th>
            <th width="50"><center>Cantidad</center></th>
            <th width="50"><center>Refrigeración</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach($transformaciones as $transfor)
            <tr>
              <td>{{ $transfor->descripcion }}</td>
              <td width="50"><center>{{ $transfor->tipo }}</center></td>
              <td width="60"><center>{{ $transfor->nivel_tension }} </center></td>
              <td width="50"><center>{{ $transfor->capacidad }} </center></td>
              <td width="50"><center>{{ $transfor->cantidad }} Und</center></td>
              <td width="50"><center>{{ $transfor->tipo_refrigeracion }}</center></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @endif

      @if(count($distribuciones) == 0)
      @else
      <table class=" table table-bordered table-striped">
        <tr>
          <th colspan="7" class="ttable">DISTRIBUCIÓN</th>
        </tr>
        <thead>
          <tr>
            <th><center>Descripción</center></th>
            <th width="50"><center>Tipo</center></th>
            <th width="50"><center>Tensión</center></th>
            <th width="50"><center>Cantidad</center></th>
            <th width="50"><center>Apoyos</center></th>
            <th width="50"><center>Cajas</center></th>
            <th width="50"><center>Notas</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach($distribuciones as $distri)
            <tr>
              <td>{{ $distri->descripcion }}</td>
              <td width="50"><center>{{ $distri->tipo }}</center></td>
              @if($distri->nivel_tension == '13,2' || $distri->nivel_tension == '13,4'|| $distri->nivel_tension == '13,8')
                <td width="50"><center>{{ $distri->nivel_tension }} KV</center></td>
              @elseif($distri->nivel_tension == 'No aplica')
                <td width="50"><center>{{ $distri->nivel_tension }} </center></td>
              @else
                <td width="50"><center>{{ $distri->nivel_tension }} V</center></td>
              @endif

              <td width="50"><center>{{ $distri->cantidad }} mts.</center></td>
              <td width="50"><center>{{ $distri->apoyos }}</center></td>
              <td width="50"><center>{{ $distri->cajas }}</center></td>
              @if($distri->notas == null)
                <td width="50"><center>N.A</center></td>
              @else
                <td width="50"><center>{{ $distri->notas }}</center></td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>

      @endif

      @if(count($pu_finales) == 0)
      @else
      <table class=" table table-bordered table-striped salte">
        <tr>
          <th colspan="7" class="ttable">USO FINAL RESIDENCIAL, COMERCIAL O INDUSTRIAL</th>
        </tr>
        <thead>
          <tr>
            <th width="190"><center>Descripción</center></th>
            <th width="50"><center>Tipo</center></th>
            <th width="40"><center>Estrato</center></th>
            <th width="50"><center>Cantidad</center></th>
            <th width="30"><center>m²</center></th>
            <th width="50"><center>KVA</center></th>

            <th width="50"><center>Acometidas</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach($pu_finales as $pu)
            <tr>
              <td><center>{{ $pu->descripcion }}</center></td>
              <td width="50"><center>{{ $pu->tipo }}</center></td>
              @if( $pu->estrato == null )
                <td width="40"> <center>N.A</center> </td>
              @else
                <td width="40"><center>{{ $pu->estrato }}</center></td>
              @endif
              <td width="50"><center>{{ $pu->cantidad }} Und</center></td>
              <td width="30"><center>{{ $pu->metros }}</center></td>
              @if($pu->kva == 'Según Plano')
                <td width="50"><center>{{ $pu->kva }}</center></td>
              @else
                <td width="50"><center>{{ $pu->kva }} KVA</center></td>
              @endif

              <td width="50"><center>{{ $pu->acometidas }}</center></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @endif
    </div>
    <div class="referencia2">
      <p><b>{{$referencia->nombre}}</b></p>


        <?php
          $refer = html_entity_decode($referencia->detalles);
          echo $refer;
        ?>

    </div>
    <br>
    <br>
    <div class="inspeccionDoc">
    <p><b>{{$inicial->nombre}}</b></p>


      <?php
        $refer = html_entity_decode($inicial->detalles);
        echo $refer;
      ?>
    </div>

    <br>
    <div class="inscricion">
    <p><b>{{$inspeccion->nombre}}</b></p>

      <?php
        $refer = html_entity_decode($inspeccion->detalles);
        echo $refer;
      ?>
    </div>

    <br>
    <div class="referencia">
      <p><b>5. PROPUESTA ECONOMICA</b></p>


      <table class="table table-bordered tabla">
        <tr>
          <th Colspan="4" ><center><label>COTIZACIÓN</label></center></th>
        </tr>
        <tr>
          <th><center><label> ÍTEM </label></center></th>
          <th><center><label> DESCRIPCIÓN DEL ALCANCE </label></center></th>
          <th><center><label> CANTIDAD </label></center></th>
          <th><center><label> VALOR </label></center></th>
        </tr>
        <?php
        $i = 0;
        $ct = count($transformaciones);
        $cd = count($distribuciones);
        $cp = count($pu_finales);

        $contador = $ct+$cd+$cp;


        ?>
        <tr style="padding:0px; margin:0px">
          <td></td>
          <td></td>
          <td></td>
          <td id="td" rowspan=<?php echo $contador+1; ?> style="vertical-align:middle; text-align:center;" >${{ number_format($total,0) }}</td>
        </tr>
        @foreach($transformaciones as $trans)
          <tr >
            <?php $i++ ?>
            <td><center>{{$i}}</center></td>
            <td>
              <p>{{ $trans->descripcion }} - {{ $trans->tipo }} - Capacidad: {{ $trans->capacidad}} KVA</p>
            </td>
            <td><center>{{ $trans->cantidad }} {{ $trans->unidad }}</center></td>

          </tr>
        @endforeach
        @foreach($distribuciones as $distri)
          <tr>
            <?php $i++ ?>
            <td><center>{{$i}}</center></td>
            <td>
              <p>{{ $distri->descripcion }} - {{ $distri->tipo }}</p>
            </td>
            <td><center>{{ $distri->cantidad }} {{ $distri->unidad }}</center></td>

          </tr>

        @endforeach
        @foreach($pu_finales as $pu)
          <tr>
            <?php $i++ ?>
            <td><center>{{$i}}</center></td>
            <td>
              <p>{{ $pu->descripcion }} - {{ $pu->tipo }}</p>
            </td>
            <td><center>{{ $pu->cantidad }} {{ $pu->unidad }}</center></td>
          </tr>
        @endforeach

        <tr>
          <td rowspan="4" style="border-left: solid white; border-bottom: solid white"></td>
          <td colspan="2"><b>Valor de la Inspección</b></td>
          <td><center>${{ number_format($total,0) }}</center></td>
        </tr>
        <tr>

          <td colspan="2"><b>IVA(19%)</b></td>
          <td><center>${{ number_format($iva,0) }}</center></td>
        </tr>
        <tr>

          <td colspan="2"><b>Total</b></td>
          <td><center>${{ number_format($valor_total,0) }}</center></td>
        </tr>
        <tr>

          <td colspan="2"><b>Costo adicional de visita por dia si se requiere:</b></td>
          <td><center>${{ $cotizaciones->adicional }}</center></td>
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
      <br>
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
          <td>{{$cotizaciones->entrega}} una vez se encuentre la documentación  completa y no se tenga NC abiertas</td>
        </tr>
        <tr>
          <td>Número de visitas de inspección  contratadas</td>
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
        <br>
        <?php
          $refer = html_entity_decode($pago->detalles);
          echo $refer;
        ?>
      </div>
    <div class="ocho">
      <div class="docu">
        <p><b>{{$docu->nombre}}</b></p>
        <?php
          $refer = html_entity_decode($docu->detalles);
          echo $refer;
        ?>
      </div>
      <div class="img">
        <img id="img" src="firma.jpg" style="height:80px;">
        <img id="img" src="Certicol2.png" style="margin-left:300px; height:80px">
      </div>
      <div class="datos">
        <?php
          $refer = html_entity_decode($datos->detalles);
          echo $refer;
        ?>
      </div>
    </div>


  </body>

</html>
