<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        font-family: "Arial Narrow", Arial, sans-serif;
      	font-size: 12px;

      }
      table {
          border-collapse: collapse;
      }

      table, td, th {
          border: 1px solid black;
          font-weight: normal;
      }
      .indice{
        font-weight: bold;
        text-align:center;
        background-color:#D9D9D9;

      }
      @page { margin: 100px 50px; }
      header { position: fixed; top: -60px; left: 0px; right: 0px; height: 100px;
                    margin-top: 25px}
      footer { position: fixed; bottom: -80px; left: 200px; right: 0px; height: 50px; }
      .page-number:after {content: counter(page); }

      #td3{
        border: solid white;
      }

    </style>
  </head>
  <body>
    <header>

      <table class="table table-bordered " cellpadding="0" cellspacing="0">
        <tr>
          <td width="100" heigth="100"><center><img id="img" src="logo.jpg" style="width:100px; opacity: 0.5;"></center></td>
          <th style="font-size:15pt; color:#808080;" width="300"><center>LISTA DE CHEQUEO DISEÑO INSTALACIONES ELÉCTRICAS</center></th>
          <td style="font-size:10pt; color:#808080; margin-top:50px;" valign="middle" width="180px"><center><p class=""><script type="text/php">
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
          <td id="td3"><center><span class="">Certicol_for_047 / Aprobado 07-07-2015 / Versión 2 </span></center></td>
        </tr>
      </table>
    </footer>
    <br>
    <br>
    <p style="font-size: 12.5px; font-weight: bold;text-decoration:underline;margin-left:200px; line-height:0.1;">INFORME DE NO CONFORMIDADES DOCUMENTALES  </p>
    <p style="font-size: 12.5px; font-weight: bold;text-decoration:underline;margin-left:310px; line-height:0.1;">HOJA 2 DE 2  </p>
    <br>
    <img src="Diseño detallado.png" style="width:250px; margin-left:130px">
    <p style="font-size: 8px;font-weight: bold;margin-left:70px;">Nombre del proyecto: {{$contrato->nombre_proyecto}}</p>
    <p style="font-size: 8px;font-weight: bold;margin-left:70px;">Codigo del proyecto: {{$contrato->codigo_proyecto}}</p>
    <p style="font-size: 8px;font-weight: bold;margin-left:81px;line-height:0.1;">Fecha de revision:  {{$fecha}}</p>
    <table border="1">
      <tr >
        <th rowspan="2" class="indice" >ÍTEM</th>
        <th coslpan="6" class="indice" rowspan="2">DESCRIPCIÓN</th>
        <th colspan="2" class="indice" >APLICA</th>
        <th colspan="2" class="indice" >CUMPLE</th>
        <th coslpan="4" class="indice" rowspan="2" style="border-left:1px;">OBSERVACIONES</th>
      </tr>
      <tr>
        <th class="indice">SI</th>
        <th class="indice">NO</th>
        <th class="indice">SI</th>
        <th class="indice" >NO</th>
      </tr>

      @foreach($criterios as $key=>$criterio)
      <tr>
        <th style="text-align:center">{{$key+1}}</th>
        <th style="font-size: 8px;" width="45%">{{$criterio->items->item}}</th>

        @if($criterio->aplica == "Si")
          <th style="font-weight: bold;text-align:center">X</th>
          <th style="text-align:center"></th>
        @elseif($criterio->aplica == "No")
          <th style="text-align:center"></th>
          <th style="font-weight: bold;text-align:center">X</th>
        @else
          <th></th>
          <th></th>
        @endif

        @if($criterio->cumple == "Si")
          <th style="font-weight: bold;text-align:center">X</th>
          <th style="text-align:center"></th>
        @elseif($criterio->cumple == "No")
          <th style="text-align:center"></th>
          <th style="font-weight: bold;text-align:center">X</th>
        @else
          <th></th>
          <th></th>
        @endif

        <th width="45%" style="font-size: 8px; ">{{$criterio->observaciones}}</th>
      </tr>
      @endforeach

    </table>
    <p style="font-size: 8px; font-weight: bold; ">Nota 1. La profundidad con que se traten los ítems dependerá del tipo de instalación, para lo cual debe aplicarse el juicio profesional del responsable del diseño.</p>

    <p style="font-size: 12.5px; font-weight: bold;text-decoration:underline; ">Nota 2. El diseñador deberá hacer mención expresa de aquellos ítems que a su juicio no apliquen.</p>
    <p style="font-size: 9px; line-height:0.1; ">Nota 3. Para un análisis de riesgos de origen eléctrico, el diseñador debe hacer una descripción de los factores de riesgos potenciales  o presentes en la instalación y las </p>
    <p style="font-size: 9px;line-height:0.0; ">recomendaciones para minimizarlos.</p>
  </body>
</html>
