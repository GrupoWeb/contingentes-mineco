@extends('template/reporte')

@section('content')
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th rowspan="2">Contingente</th>
				<th rowspan="2">Fracción Arancelaria</th>
				<th colspan="3" class="text-center">Volumen</th>
				<th rowspan="2" class="text-center">% de utilización</th>
			</tr>
			<tr>
				<th class="text-center">Activado</th>
				<th class="text-center">Asignado</th>
				<th class="text-center">Emitido</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tratados as $nombrecorto=>$contingentes)
				<tr>
					<td colspan="6" class="active"><strong>{{ $nombrecorto }}</strong></td>
				</tr>
				@foreach($contingentes as $contingente)
					<tr>
						<td rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ $contingente['producto'] }}</td>
						<td class="text-center">{{ reset($contingente['partidas']) }}</td>
						<td class="text-right" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ number_format($contingente['activado'],3) }}</td>
						<td class="text-right" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ number_format($contingente['asignado'],3) }}</td>
						<td class="text-right" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ number_format($contingente['emitido'],3) }}</td>
						<td class="text-right" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ $contingente['utilizado'] }}</td>
					</tr>
					@for($i=1; $i<count($contingente['partidas']); $i++)
						<tr>
							<td class="text-center">{{ $contingente['partidas'][$i] }}</td>
						</tr>
					@endfor
				@endforeach
			@endforeach
		</tbody>
	</table>
	
@stop