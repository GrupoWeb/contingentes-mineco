@extends('template/reporte')

@section('content')
	@foreach($movimientos as $contingente=>$valores)
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th class="text-center" style="vertical-align: middle;">Nombre del importador</th>
					@if($asignaciones[$contingente] == 1)
						<th class="text-center" style="vertical-align: middle;">Volumen autorizado</th>
					@endif
					<th class="text-center" style="vertical-align: middle;">Volumen <br />asignado en certificados</th>
					<th class="text-center" style="vertical-align: middle;">Volumen importado</th>
					<th class="text-center" style="vertical-align: middle;">Saldo</th>
					<th class="text-center" style="vertical-align: middle;">% Utilización<br/> del total</th>
				</tr>
			</thead>
			<tbody>
				<?php $totalporcentaje=0;?>
				@foreach($valores as $empresa=>$lectura)
					@if($asignaciones[$contingente] == 1)
						<?php $porcentaje = ($lectura['emitido']/$totales[$contingente]['totalasignacion'])*100; $totalporcentaje += $porcentaje; ?>
					@else
						<?php $porcentaje = ($lectura['emitido']/$totales[$contingente]['totalemitido'])*100; $totalporcentaje += $porcentaje; ?>
					@endif
					<tr>
						<td>{{ $empresa }}</td>
						@if($asignaciones[$contingente] == 1)
							<td class="text-right">{{ number_format($lectura['asignado'], 3) }}</td>
						@endif
						<td class="text-right">{{ number_format($lectura['emitido'], 3) }}</td>
						<td class="text-right">{{ number_format($lectura['liquidado'], 3) }}</td>
						<td class="text-right">{{ number_format($lectura['saldo'], 3) }}</td>
						<td class="text-right">{{ number_format($porcentaje, 2) }}%</td>
					</tr>
				@endforeach
				<tr>
					<td class="text-right"><strong>TOTAL</strong></td>
					@if($asignaciones[$contingente] == 1)
						<td class="text-right"><strong>{{ number_format($totales[$contingente]['totalasignacion'], 3) }}</strong></td>
					@endif
					<td class="text-right"><strong>{{ number_format($totales[$contingente]['totalemitido'], 3) }}</strong></td>
					<td class="text-right"><strong>{{ number_format($totales[$contingente]['totalimportado'], 3) }}</strong></td>
					<td class="text-right"><strong>{{ number_format($totales[$contingente]['totalsaldo'], 3) }}</strong></td>
					<td class="text-right"><strong>{{ number_format($totalporcentaje, 2) }}%</strong></td>
				</tr>
			</tbody>
		</table>
	@endforeach
@stop