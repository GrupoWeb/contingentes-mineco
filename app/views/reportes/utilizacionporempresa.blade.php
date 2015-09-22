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
				<th class="text-center" style="vertical-align: middle;">Empresa</th>
				@if($esAsignacion == 1)
					<th class="text-center" style="vertical-align: middle;">Volumen<br> asignado</th>
				@endif
				<th class="text-center" style="vertical-align: middle;">Volumen <br />en certificados</th>
				<th class="text-center" style="vertical-align: middle;">Volumen <br>importado</th>
				<th class="text-center" style="vertical-align: middle;">Saldo</th>
				<th class="text-center" style="vertical-align: middle;">% Utilización</th>
			</tr>
		</thead>

		<tbody>
		<?php $totalporcentaje=0; $totalconsumo=0; $totalliquidado=0; $totalasignado=0; $totalsaldo=0; ?>

		@foreach($movimientos as $movimiento)
			
			<?php 
				if ($movimiento->totalperiodo<>0)
					$porcentaje       = $movimiento->consumo*100/$movimiento->totalperiodo;
				else
					$porcentaje = 0;
				
				
				$totalconsumo    += $movimiento->consumo;
				$totalliquidado  += $movimiento->liquidado;
				$totalasignado   += $movimiento->asignado;

				if($esAsignacion)
					$saldo            = $movimiento->asignado-$movimiento->consumo;
				else
					$saldo            = $movimiento->liquidado;

				$totalsaldo      += $saldo;
				$totalporcentaje += $porcentaje;
			?>

			<tr>
				<td>{{ $movimiento->razonsocial }}</td>
				@if($esAsignacion == 1)
					<td class="text-center">{{ number_format($movimiento->asignado, 3) }}</td>
				@endif
				<td class="text-center">{{ number_format($movimiento->consumo, 3) }}</td>
				<td class="text-center">{{ number_format($movimiento->liquidado, 3) }}</td>
				<td class="text-center">{{ number_format($saldo, 3) }}</td>
				<td class="text-center">{{ number_format($porcentaje, 2) }}%</td>
			</tr>
		@endforeach				
		</tbody>

		<tbody>
			<tr>
				<td>&nbsp;</td>
				@if($esAsignacion == 1)
					<td class="text-center"><strong>{{ number_format($totalasignado, 3) }}</strong></td>
				@endif
				<td class="text-center"><strong>{{ number_format($totalconsumo, 3) }}</strong></td>
				<td class="text-center"><strong>{{ number_format($totalliquidado, 3) }}</strong></td>
				<td class="text-center"><strong>{{ number_format($totalsaldo, 3) }}</strong></td>
				<td class="text-center">&nbsp;</td>
			</tr>
		</tbody>
	</table>

@stop