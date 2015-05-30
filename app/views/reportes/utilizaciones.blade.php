@extends('template/reporte')

@section('content')
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th rowspan="2">NIT</th>
				<th rowspan="2">Importador</th>
				<th colspan="3" class="text-center">Volúmen</th>
				<th colspan="5" class="text-center">Adjudicado</th>
				<th colspan="7" class="text-center">Liquidado</th>
			</tr>
			<tr>
				@if($esasignacion==1)
					<th>Asignado</th>
					<th>Adjudicado</th>
					<th>Saldo</th>
				@else
					<th colspan="3">Adjudicado</th>
				@endif
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
						<?php $cuantos = count($movimientos['movimientos']); ?>
						<td rowspan="{{ $cuantos }}">{{ $nit }}</td>
						<td rowspan="{{ $cuantos }}">{{ $nombre }}</td>
						@if($esasignacion==1)
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['asignado'], 3) }}</td>
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['adjudicado'], 3) }}</td>
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['asignado']-$movimientos['adjudicado'], 3) }}</td>
						@else
							<td rowspan="{{ $cuantos }}" colspan="3" class="text-right">{{ number_format($movimientos['adjudicado'], 3) }}</td>
						@endif
						<?php $i=1; ?>
						@foreach($movimientos['movimientos'] as $movimiento)
							@if ($i>1) 
								{{'<tr>'}} 
							@endif
								<td>{{ $movimiento['certificado']  }}</td>
								<td>{{ $movimiento['fecha'] }}</td>
								<td>{{ $movimiento['fraccion'] }}</td>
								<td>{{ $movimiento['fechavencimiento'] }}</td>
								<td class="text-right">{{ number_format($movimiento['cantidad'], 3) }}</td>
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
							</tr>
							<?php $i++; ?>
						@endforeach
				@endforeach
			@endforeach
		</tbody>
	</table>
@stop