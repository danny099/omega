<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        font-family: "Arial Narrow", Arial, sans-serif;
      	font-size: 10px;

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


    <table border="1">

      <tr>
        <th style="text-align:center;font-weight: bold; background-color:#D9D9D9" colspan="7">
          LISTA DE CHEQUEO DISEÑO SIMPLIFICADO Y CASOS DE REEMPLAZO DE DISEÑO
        </th>
      </tr>
      <tr>
        <th colspan="7">
          <p style="font-size: 8px;font-weight: bold;margin-left:70px;">Nombre del proyecto: {{$contrato->nombre_proyecto}}</p>
          <p style="font-size: 8px;font-weight: bold;margin-left:70px;">Codigo del proyecto: {{$contrato->codigo_proyecto}}</p>
          <p style="font-size: 8px;font-weight: bold;margin-left:81px;line-height:0.1;">Fecha de revision: {{$fecha}}</p>
        </th>
      </tr>
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
        <th class="indice">NO</th>
      </tr>

      @foreach($criterios as $key=>$criterio)
      @if($key == 0 || $key == 9 || $key == 16 )
      <tr>
        <th style="text-align:center;font-weight: bold; background-color:#D9D9D9">{{$key+1}}</th>
        <th style="font-size: 9px;font-weight: bold; background-color:#D9D9D9" width="45%" colspan="6">{{$criterio->items->item}}</th>
      </tr>
      @else
      <tr>
        <th style="text-align:center">{{$key+1}}</th>
        <th style="font-size: 9px;" width="45%">{{$criterio->items->item}}</th>

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

        <th width="45%">{{$criterio->observaciones}}</th>
      </tr>
      @endif
      @endforeach
      <tr>
        <th colspan="7" style="font-weight: bold; background-color:#D9D9D9">Nota</th>
      </tr>
      <tr>
        <th colspan="7" >
          El diseño simplificado debe ser suscrito por el profesional competente responsable de la construcción de la instalación eléctrica o quien la supervise, con su nombre, apellido, numero de cedula de ciudadanía y
          numero de matricula profesional de conformidad con la ley que regula el ejercicio de la profesión. Dicho diseño debe ser entregado al propietario de la instalación.</th>
      </tr>
    </table>

  </body>
</html>
