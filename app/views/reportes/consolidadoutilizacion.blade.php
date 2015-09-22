@extends('template/reporte')
@section('content')

	<table class="table table-striped table-bordered blue">
		<thead>
			<tr>
				<th rowspan="2" colspan="1" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th rowspan="1" colspan="5" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>

			<tr>
				<th rowspan="1" colspan="2" class="text-center bg-white">{{ $tratado }}</th>
				<th rowspan="1" colspan="1" class="text-center bg-white">{{ $producto }}</th>
				<th rowspan="1" colspan="2" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>

			<tr>
				<th rowspan="2" colspan="" style="vertical-align: middle;">Contingente</th>
				<th rowspan="2" colspan="" style="vertical-align: middle;">Fracción Arancelaria</th>
				<th rowspan="" colspan="3" class="text-center">Volumen</th>
				<th rowspan="2" colspan="" style="vertical-align: middle;" class="text-center">% de utilización</th>
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
					<td colspan="6" class="active"><strong>{{ $nombrecorto.' ('.$contingentes['tipo'].')' }}</strong></td>
				</tr>
				@foreach($contingentes['datos'] as $contingente)
					<tr>
						<td rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ $contingente['producto'] }}</td>
						<td class="text-center">{{ reset($contingente['partidas']) }}</td>
						<td class="text-center" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ number_format($contingente['activado'],3) }}</td>
						<td class="text-center" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">
							{{ ($contingentes['tipo'] == 'PTPD' ? number_format($contingente['emitido'],3)  : number_format($contingente['asignado'],3)) }}
						</td>
						<td class="text-center" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ number_format($contingente['emitido'],3) }}</td>
						<td class="text-center" rowspan="{{ count($contingente['partidas']) }}" style="vertical-align: middle;">{{ $contingente['utilizado'] }}</td>
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

	
	<p>*
		@foreach($tipos as $corto=>$largo)
			{{ '<strong>'.$corto.'</strong>: '.$largo }}<br />&nbsp;
		@endforeach
	</p>
@stop