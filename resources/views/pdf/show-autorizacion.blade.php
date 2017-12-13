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
			<h1>AUTORIZACIÓN DE DICTÁMENES</h1>
		<center>
	</div>

	<div>
		<p>nombre del proyecto:  {{$contrato->nombre_proyecto}}</p>
		<p>codigo del proyecto:  {{$contrato->codigo_proyecto}}</p>
	</div>

	<table border="1">
		@foreach($autorizaciones as $key=>$autorizacion)
			<tr>
				<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;text-align: center;width:150px;height:12px">Autorizado por:</th>
				<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;text-align: center;width:250px">Firma</th>
				<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;text-align: center;width:550px">Observaciones</th>
			</tr>
			<tr>
				<th style="text-align: center;height:20px">{{$nombres[$key]}}</th>
				<th rowspan="2"> <center><img src="{{$autorizacion->firma}}" width="90px"></center> </th>
				<th rowspan="2">{{$autorizacion->observaciones}}</th>
			</tr>
			<tr>
				<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;text-align: center;height:20px">{{$cargos[$key]}}</th>
			</tr>
			<tr>
				<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;text-align: center;height:12px">Fecha de autorización</th>
				<th style="text-align: center">{{$autorizacion->fecha}}</th>
				<th></th>
			</tr>
		@endforeach
	</table>
	<br>
	<table>
		<tr>

			<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;width:160px">Proceso</th>
			<th style="font-weight: bold;text-align:center;background-color:#F2F2F2;width:250px">Cantidad autorizada</th>
		</tr>
		@if($cantidades->transformacion != null)
		<tr>
			<th>Transformacion</th>
			<th style="text-align:center">{{$cantidades->transformacion}}</th>
		</tr>
		@endif
		@if($cantidades->red_mt != null)
		<tr>
			<th>Red mt (m)</th>
			<th style="text-align:center">{{$cantidades->red_mt}}</th>
		</tr>
		@endif
		@if($cantidades->red_bt != null)
		<tr>
			<th>Red bt (m)</th>
			<th style="text-align:center">{{$cantidades->red_bt}}</th>
		</tr>
		@endif
		@if($cantidades->casas != null)
		<tr>
			<th>Casas</th>
			<th style="text-align:center">{{$cantidades->casas}}</th>
		</tr>
		@endif
		@if($cantidades->apartamentos != null)
		<tr>
			<th>Apartamentos</th>
			<th style="text-align:center">{{$cantidades->apartamentos}}</th>
		</tr>
		@endif
		@if($cantidades->zonas != null)
		<tr>
			<th>Zonas</th>
			<th style="text-align:center">{{$cantidades->zonas}}</th>
		</tr>
		@endif
		@if($cantidades->locales != null)
		<tr>
			<th>Locales</th>
			<th style="text-align:center">{{$cantidades->locales}}</th>
		</tr>
		@endif
		@if($cantidades->bodegas != null)
		<tr>
			<th>Bodegas</th>
			<th style="text-align:center">{{$cantidades->bodegas}}</th>
		</tr>
		@endif
		@if($cantidades->puntos_fijos != null)
		<tr>
			<th>Puntos Fijos</th>
			<th style="text-align:center">{{$cantidades->puntos_fijos}}</th>
		</tr>
		@endif

	</table>
</body>
</html>
