@extends('template/reporte')

@section('content')
	<table class="table table-bordered table-condensed">
		<thead>
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
					<td class="text-right">{{ number_format($movimiento->asignado, 3) }}</td>
				@endif
				<td class="text-right">{{ number_format($movimiento->consumo, 3) }}</td>
				<td class="text-right">{{ number_format($movimiento->liquidado, 3) }}</td>
				<td class="text-right">{{ number_format($saldo, 3) }}</td>
				<td class="text-right">{{ number_format($porcentaje, 2) }}%</td>
			</tr>
		@endforeach				
		</tbody>
		<tfoot>
			<tr>
				<td>&nbsp;</td>
				@if($esAsignacion == 1)
					<td class="text-right"><strong>{{ number_format($totalasignado, 3) }}</strong></td>
				@endif
				<td class="text-right"><strong>{{ number_format($totalconsumo, 3) }}</strong></td>
				<td class="text-right"><strong>{{ number_format($totalliquidado, 3) }}</strong></td>
				<td class="text-right"><strong>{{ number_format($totalsaldo, 3) }}</strong></td>
				<td class="text-right">&nbsp;</td>
			</tr>
		</tfoot>
	</table>

@stop