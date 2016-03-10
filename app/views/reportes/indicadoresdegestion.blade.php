@extends('template/reporte')

@section('content')
	<table class="table table-striped table-bordered blue" style="font-size: 10px;">
		<thead>
			<tr>
				<th rowspan="2" colspan="5" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th rowspan="1" colspan="16" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>
			<tr>
				<th rowspan="1" colspan="3" class="text-center bg-white">{{ $tratado }}</th>
				<th rowspan="1" colspan="3" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>
			<tr>
				<th>No.</th>
				<th>Contingente</th>
				<th>Empresa solicitante</th>
				<th>Fecha de solicitud de inscripción</th>
				<th>Fecha de autorización de inscripción</th>
				<th>Observaciones</th>
				<th>
					<table>
						<thead>
							<tr>
								<th colspan="6" class="text-center">Asignaciones</th>
							</tr>
							<tr>
								<th width="16%">Fecha de silicitud de asignación</th>
								<th width="16%">Volumen solicitado</th>
								<th width="16%">Fecha de aprobación</th>
								<th width="16%">Volumen aprobado</th>
								<th width="16%">Acta de aprobación de asignación</th>
								<th width="16%">Observaciones</th>
							</tr>
						</thead>
					</table>
				</th>
				<th>
					<table>
						<thead>
							<tr>
								<th colspan="5" class="text-center">Emisiones</th>
							</tr>
							<tr>
								<th width="20%">Fecha de solicitud para la emisión de certificado</th>
								<th width="20%">Fecha de emisión de certificado</th>
								<th width="20%">Volumen atorizado TM</th>
								<th width="20%">Fracción arancelaria</th>
								<th width="20%">Observaciones</th>
							</tr>
						</thead>
					</table>
				</th>
				<th>Responsable</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; ?>
			@foreach($datos as $contingente => $empresas)
					@foreach($empresas as $empresa => $valores)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $contingente }}</td>
							<td>{{ $empresa }}</td>
							<td>{{ $valores['inscripcion']['solicitud'] }}</td>
							<td>{{ $valores['inscripcion']['proceso'] }}</td>
							<td>{{ $valores['inscripcion']['observaciones'] }}</td>
							<td>
								<table>
									@if(isset($valores['asignaciones']))
										@foreach($valores['asignaciones'] as $asignacion)
											<tr>
												<td width="16%">{{ $asignacion['solicitud'] }}</td>
												<td width="16%">{{ $asignacion['solicitado'] }}</td>
												<td width="16%">{{ $asignacion['proceso'] }}</td>
												<td width="16%">{{ $asignacion['asignado'] }}</td>
												<td width="16%">{{ $asignacion['acta'] }}</td>
												<td width="16%">{{ $asignacion['observaciones'] }}</td>
											</tr>
										@endforeach
									@endif
								</table>
							</td>
							<td>
								<table>
									@if(isset($valores['emisiones']))
										@foreach($valores['emisiones'] as $emision)
											<tr>
												<td width="16%">{{ $emision['solicitud'] }}</td>
												<td width="16%">{{ $emision['proceso'] }}</td>
												<td width="16%">{{ $emision['emitido'] }}</td>
												<td width="16%">{{ $emision['partida'] }}</td>
												<td width="16%">{{ $emision['observaciones'] }}</td>
											</tr>
										@endforeach
									@endif
								</table>
							</td>
							<td>{{ $valores['inscripcion']['responsable'] }}</td>
						</tr>
						<?php $i++; ?>
					@endforeach
			@endforeach
		</tbody>
	</table>
@stop














