<style>
	.size14 {
		font-size: 14px;
	}

	.size12 {
		font-size: 12px;
	}

	.size6 {
		font-size: 6px;
	}

	.underline {
		text-decoration: underline;
	}

	.italics {
		font-style: italic;
	}

	.bold {
		font-style: bold;
	}

	.center {
		text-align: center;
	}

	.border {
		border: 1px solid black;
	}
</style>

<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<th rowspan="2">DACE - MINECO</th>
		<th colspan="3" class="text-center"><h4>{{$titulo}}</h4></th>
	</tr>
	<tr>
		<th>{{ $tratado }}</th>
		<th>{{ $producto }}</th>
		<th>Reporte generado {{ date('d/m/Y') }}</th>
	</tr>
</table>
<br /><br /><br />
<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<thead>
		<tr>
			<th rowspan="2">NIT</th>
			<th rowspan="2">Importador</th>
			<th rowspan="2">Vol. Asignado</th>
			<th colspan="5" align="center">Adjudicado</th>
			<th colspan="7" align="center">Liquidado</th>
		</tr>
		<tr>
			<th>No.</th>
			<th>Fecha</th>
			<th>Fracción</th>
			<th>Venicimiento</th>
			<th>TM</th>
			<th>Fecha</th>
			<th>DUA</th>
			<th>TM</th>
			<th>Variación</th>
			<th>%</th>
			<th>CIF</th>
			<th>$/TM</th>
		</tr>
	</thead>
	<tbody>
		@foreach($utilizaciones as $nit=>$valores)
			@foreach($valores as $nombre=>$movimientos)
				<tr>
					<td rowspan="{{ count($movimientos) }}">{{ $nit }}</td>
					<td rowspan="{{ count($movimientos) }}">{{ $nombre }}</td>
					<td rowspan="{{ count($movimientos) }}">{{ number_format($movimientos['adjudicado'], 3) }}</td>
					<?php $i=1; ?>
					@foreach($movimientos['movimientos'] as $movimiento)
						@if($i==2)
							</tr><tr>
						@endif
							<td>{{ $movimiento['certificado'] }}</td>
							<td>{{ $movimiento['fecha'] }}</td>
							<td>{{ $movimiento['fraccion'] }}</td>
							<td>{{ $movimiento['fechavencimiento'] }}</td>
							<td>{{ number_format($movimiento['cantidad'], 3) }}</td>
							@if($movimiento['dua'] <> '')
								<td>{{ $movimiento['fechaliquidacion'] }}</td>
								<td>{{ $movimiento['dua'] }}</td>
								<td>{{ number_format($movimiento['real'], 3) }}</td>
								<td>{{ $movimiento['variacion'] }}</td>
								<td>{{ number_format((($movimiento['real'] * 100)/$movimiento['cantidad']), 2) }}</td>
								<td>{{ number_format($movimiento['cif'], 2) }}</td>
								<td>{{ $movimiento['real'] <> 0 ? (number_format(($movimiento['cif']/$movimiento['real']), 2)) : '0.00' }}</td>
							@else
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							@endif
						@if($i<>1)
							</tr>
						@endif
						<?php $i++; ?>
					@endforeach
			@endforeach
		@endforeach
	</tbody>
</table>