<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css" media="screen">
		body{
			margin: 5px;
			font-family: "Arial Narrow", Arial, sans-serif;
			font-size: 12px;
		}
		.titulo{

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

	</style>

</head>
<body>

	<div class="titulo">
		<center style="display: inline-block;">
			<img id="img" src="logo.jpg" style="width:100px; position:absolute;">

			<h1>ESTADO DE DICTÁMENES</h1>
		<center>
	</div>

	<div>
		<p>nombre del proyecto:  {{$contrato->nombre_proyecto}}</p>
		<p>codigo del proyecto:  {{$contrato->codigo_proyecto}}</p>
	</div>

	<table border="1" width="100%">
			<tr>
				<th style="text-align: center;font-size: 11px">Inspector</th>
				<th style="text-align: center;font-size: 11px;width: 70px;">Matricula</th>
				<th style="text-align: center;font-size: 11px">Director tecnico</th>
				<th style="text-align: center;font-size: 11px;width: 70px;">Matricula</th>
				<th style="text-align: center;font-size: 11px">Codigo dictamenes</th>
				<th style="text-align: center;font-size: 11px">Proceso dictaminado</th>
				<th style="text-align: center;font-size: 11px;width: 50px">Cantidad</th>
				<th style="text-align: center;font-size: 11px">equipo</th>
				<th style="text-align: center;font-size: 11px">Fecha inspección (desde)</th>
				<th style="text-align: center;font-size: 11px">Fecha inspección (hasta)</th>
				<th style="text-align: center;font-size: 11px;width: 100px;">Fecha autodeclaraciones</th>
			</tr>
			@foreach($dictamenes as $key => $dictamen)
				<tr>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->inspectores->nombres }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->matricula }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->director_tec }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->matricula_tec }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->codigo_dic }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->proceso_dic }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->cantidad }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->equipo }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->fecha_des }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->fecha_has }}</td>
					<td style="text-align: center;font-size: 11px">{{ $dictamen->fecha_auto }}</td>

				</tr>
			@endforeach
			</table>
			<br>
			<br>
			<br>
			<table border=1>
	          <tr>
	            <th>Proceso</th>
	            <th>Cantidad contratada</th>
	            <th>Cantidad dictaminada</th>
	            <th>Falta dictaminar</th>
	          </tr>
	            @if($cantidad_t > 0)
	            <tr>
	                <th>Transformacion</th>
	                <th>{{$cantidad_t}}</th>
	                <th>{{$dictaminado_t}}</th>
	                <th>{{$cantidad_t-$dictaminado_t}}</th>
	            </tr>
	            @endif

	            @if($cantidad_dm > 0)
	            <tr>
	                <th>Red MT (m)</th>
	                <th>{{$cantidad_dm}}</th>
	                <th>{{$dictaminado_dm}}</th>
	                <th>{{$cantidad_dm-$dictaminado_dm}}</th>
	            </tr>
	            @endif

	            @if($cantidad_db > 0)
	            <tr>
	                <th>Red BT (m)</th>
	                <th>{{$cantidad_db}}</th>
	                <th>{{$dictaminado_db}}</th>
	                <th>{{$cantidad_db-$dictaminado_db}}</th>
	            </tr>
	            @endif

	            @foreach($pu_final as $pu)
	              @if($pu->tipo == "Casa")
	              <tr>
	                  <th>Casas</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_casas}}</th>
	                  <th>{{$pu->cantidad-$dic_casas}}</th>
	              </tr>

	              @endif

	              @if($pu->tipo == "Apartamentos")
	              <tr>
	                  <th>Apartamentos</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_aparta}}</th>
	                  <th>{{$pu->cantidad-$dic_aparta}}</th>

	              </tr>
	              @endif

	              @if($pu->tipo == "Zona común")
	              <tr>
	                  <th>Zonas comunes</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_zonas}}</th>
	                  <th>{{$pu->cantidad-$dic_zonas}}</th>

	              </tr>
	              @endif

	              @if($pu->tipo == "Local comercial")
	              <tr>
	                  <th>Locales comerciales</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_locales}}</th>
	                  <th>{{$pu->cantidad-$dic_locales}}</th>

	              </tr>
	              @endif

	              @if($pu->tipo == "Bodega")
	              <tr>
	                  <th>Bodegas</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_bodegas}}</th>
	                  <th>{{$pu->cantidad-$dic_bodegas}}</th>

	              </tr>
	              @endif

	              @if($pu->tipo == "Punto fijo")
	              <tr>
	                  <th>Puntos fijos</th>
	                  <th>{{$pu->cantidad}}</th>
	                  <th>{{$dic_fijos}}</th>
	                  <th>{{$pu->cantidad-$dic_fijos}}</th>

	              </tr>
	              @endif
	            @endforeach
	          </tr>
	        </table>
</body>
</html>
