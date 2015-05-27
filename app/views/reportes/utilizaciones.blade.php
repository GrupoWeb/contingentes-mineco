@extends('template/reporte')

@section('content')
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th rowspan="2">NIT</th>
				<th rowspan="2">Importador</th>
				<th rowspan="2">Vol. Asignado</th>
				<th colspan="5" class="text-center">Adjudicado</th>
				<th colspan="7" class="text-center">Liquidado</th>
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
@stop