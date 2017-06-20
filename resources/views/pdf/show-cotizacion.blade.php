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
        <p>Lunes 19 de junio de 2017</p>
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
    </div>
    <div class="div2">
      <p class="obj1">
        Objeto:
      </p>
      <p class="obj2" align="justify">
        Este Documento Constitye la Oferta Tecnica y Economica para la prestación de servicios
        de inspectoria RETIE a las instalaciones electricas del proyecto Oasis del Este Ubicado
        en el Municipio de Pasto departamento del Nariño.
      </p>
    </div>
      <br>

    <div class="div3">
      <p>Cordial Saludo:</p>
      <br>
      <div class="cordial">
        <p class="tx1">
          Atendiendo su solicitud y la información descrita o enviada a nuestro departamento de administrativo o gerencial, nos permitimos presentar nuestra oferta para la realización
          de la inspección eléctrica del Objeto en este documento, de acuerdo a las especifiaciones del reglamento Técnico de Instalaciones Eléctricas RETIE - Resolución 90708 de Agosto de 2013
          - Resolución 90795 de Julio del 2014 - Resolución 40492 de 24 Abril del 2015 del Ministerio de Minas y Energía.
        </p>
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
            <th>CajasS</th>
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
      <!-- <div style="page-break-after:always;"></div> -->
      <table class="table table-bordered table-striped">
        @if(count($transformaciones) == 0)
        @else
          <tr>
            <td rowspan="5"><p>Transformación asociado a Uso Final</p></td>
            <td><p>Nivel de Tensión (KV)</p></td>
            <td><p>Madrid</p></td>
          </tr>
          <tr>
            <td><p>Numero de Transformadores</p></td>
            <td><p>Paris</p></td>
          </tr>
          <tr>
            <td><p>Potencia</p></td>
            <td><p>Londres</p></td>
          </tr>
          <tr>
            <td><p>Montaje</p></td>
            <td><p>Londres</p></td>
          </tr>
          <tr>
            <td><p>Tipo de Refrigeración</p></td>
            <td><p>Londres</p></td>
          </tr>
        @endif

        @if(count($distribuciones) == 0)
        @else
          <tr>
            <td rowspan="7"><p>Distribución asociado a Uso Final</p></td>
            <td><p>Descripcion</p></td>
            <td><p>Washington</p></td>
          </tr>
          <tr>
            <td><p>Tipo de Red</p></td>
            <td><p>Toronto</p></td>
          </tr>
          <tr>
            <td><p>Nivel de Tensión</p></td>
            <td><p>Mexico</p></td>
          </tr>
          <tr>
            <td><p>Longitu de Red</p></td>
            <td><p>Mexico</p></td>
          </tr>
          <tr>
            <td><p>Numero de Apoyos o Estructuras</p></td>
            <td><p>Mexico</p></td>
          </tr>
          <tr>
            <td><p>Numero de Apoyos o Estructuras</p></td>
            <td><p>Mexico</p></td>
          </tr>
          <tr>
            <td><p>Numero de Cajas de Inspección</p></td>
            <td><p>Mexico</p></td>
          </tr>
        @endif
      </table>
    </div>
  </body>
</html>
