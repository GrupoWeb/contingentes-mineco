@extends('template/reporte')
@section('content')

	<table class="table table-striped table-bordered blue">
		<thead>
			<tr>
				<th rowspan="2" colspan="5" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th rowspan="1" colspan="12" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>
			<tr>
				<th rowspan="1" colspan="3" class="text-center bg-white">{{ $tratado }}</th>
				<th rowspan="1" colspan="4" class="text-center bg-white">{{ $producto }}</th>
				<th rowspan="1" colspan="5" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>

			<tr>
				@if($esasignacion==1)
					<th rowspan="2" colspan="1" style="vertical-align: middle;">Asignado</th>
					<th rowspan="2" colspan="1" style="vertical-align: middle;">Adjudicado</th>
					<th rowspan="2" colspan="1" style="vertical-align: middle;">Saldo</th>
				@else
					<th colspan="3">Adjudicado</th>
				@endif
				<th rowspan="2" colspan="1" style="vertical-align: middle;">NIT</th>
				<th rowspan="2" colspan="1" style="vertical-align: middle;">Importador</th>
				<th rowspan="1" colspan="3" class="text-center">Volúmen</th>
				<th rowspan="1" colspan="5" class="text-center">Adjudicado</th>
				<th rowspan="1" colspan="4" class="text-center">Liquidado</th>
			</tr>
			<tr>

				<th class="text-center">No.</th>
				<th class="text-center">Fecha</th>
				<th class="text-center">Fracción</th>
				<th class="text-center">Venicimiento</th>
				<th class="text-center">TM</th>
				<th class="text-center">Fecha</th>
				<th class="text-center">DUA</th>
				<th class="text-center">TM</th>
				<th class="text-center">Variación</th>
				<th class="text-center">%</th>
				<th class="text-center">CIF</th>
				<th class="text-center">$/TM</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$asignadot     = 0;
				$adjudicadot   = 0;
				$volumentotalt = 0;
			?>
			@foreach($utilizaciones as $nit=>$valores)
				@foreach($valores as $nombre=>$movimientos)
					<?php
						$cuantos        = count($movimientos['movimientos']);
						$asignadot     += $movimientos['asignado'];
						$adjudicadot   += $movimientos['adjudicado'];
						$volumentotalt  = $movimientos['volumentotal'];

						if ($cuantos==0) $cuantos=1;
					?>
					<tr>
						<td rowspan="{{ $cuantos }}" style="vertical-align: middle;">{{ $nit }}</td>
						<td rowspan="{{ $cuantos }}" style="vertical-align: middle;">{{ $nombre }}</td>
						@if($esasignacion==1)
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['asignado'], 3) }}</td>
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['adjudicado'], 3) }}</td>
							<td rowspan="{{ $cuantos }}" class="text-right">{{ number_format($movimientos['asignado']-$movimientos['adjudicado'], 3) }}</td>
						@else
							<td rowspan="{{ $cuantos }}" colspan="3" class="text-right" style="vertical-align: middle;">{{ number_format($movimientos['adjudicado'], 3) }}</td>
						@endif
						<?php $i=1; ?>
						@if(count($movimientos['movimientos'])==0)
							<td colspan="12">&nbsp;</td>
						</tr>
						@endif

						@foreach($movimientos['movimientos'] as $movimiento)
							@if ($i>1) 
								{{'<tr>'}} 
							@endif
								<?php $variacion = $movimiento['cantidad'] - $movimiento['real']; ?>
								<td class="text-center">{{ $movimiento['certificado']  }}</td>
								<td class="text-center">{{ $movimiento['fecha'] }}</td>
								<td class="text-center">{{ $movimiento['fraccion'] }}</td>
								<td class="text-center">{{ $movimiento['fechavencimiento'] }}</td>
								<td class="text-center">{{ number_format($movimiento['cantidad'], 3) }}</td>
								@if($movimiento['dua'] <> '')
									<td class="text-center">{{ $movimiento['fechaliquidacion'] }}</td>
									<td class="text-center">{{ $movimiento['dua'] }}</td>
									<td class="text-center">{{ number_format($movimiento['real'], 3) }}</td>
									<td class="text-center">{{ number_format($variacion, 3)  }}</td>
									<td class="text-center">{{ number_format((($variacion * 100)/$movimiento['real']), 3) }}</td>
									<td class="text-center">{{ number_format($movimiento['cif'], 2) }}</td>
									<td class="text-center">{{ $movimiento['real'] <> 0 ? (number_format(($movimiento['cif']/$movimiento['real']), 2)) : '0.00' }}</td>
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
	<br><br>
	<div class="row">
		<div class="col-sm-6">
			<table class="table table-striped table-bordered table-condensed blue">
				<tbody>
				<tr>
					<td>Cuota total</td>
					<td class="text-center"><strong>{{ number_format($volumentotalt, 3) }}</strong></td>
				</tr>
				@if($esasignacion==1)
				<tr>
					<td>Asignado</td>
					<td class="text-center"><strong>{{ number_format($asignadot, 3) }}</strong></td>
				</tr>
				@endif
				<tr>
					<td>Adjudicado</td>
					<td class="text-center"><strong>{{ number_format($adjudicadot, 3) }}</strong></td>
				</tr>
				@if($esasignacion==1)
				<tr>
					<td>Saldo</td>
					<td class="text-center"><strong>{{ number_format($asignadot-$adjudicadot, 3) }}</strong></td>
				</tr>
				@else
				<tr>
					<td>Saldo</td>
					<td class="text-center"><strong>{{ number_format($volumentotalt-$adjudicadot, 3) }}</strong></td>
				</tr>
				@endif
				
			</table>
		</div>
	</div>
@stop