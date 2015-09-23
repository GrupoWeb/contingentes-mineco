<table width="100%" cellpadding="3" style="font-size: 9px; line-height: 12px" border="1">
	<thead>
		<tr>
			<th rowspan="2" colspan="2" style="text-align:center;"><img src="{{ public_path() }}/images/logo-menu.png"></th>
			<th colspan="3" style="text-align:center;"><h4>{{$titulo}}</h4></th>
		</tr>
		<tr>
			<th style="text-align:center;">{{ $tratado }}</th>
			<th style="text-align:center;">{{ $producto }}</th>
			<th style="text-align:center;">Reporte generado {{ date('d/m/Y') }}</th>
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
				<td style="text-alight: right;">{{ number_format($movimiento->consumo, 3) }}</td>
				<td style="text-alight: right;">{{ number_format($movimiento->liquidado, 3) }}</td>
				<td style="text-alight: right;">{{ number_format($saldo, 3) }}</td>
				<td style="text-alight: right;">{{ number_format($porcentaje, 2) }}%</td>
			</tr>
		@endforeach				
	</tbody>
	<tfoot>
		<tr>
			<td>&nbsp;</td>
			@if($esAsignacion == 1)
				<td style="text-alight: right;"><strong>{{ number_format($totalasignado, 3) }}</strong></td>
			@endif
			<td style="text-alight: right;"><strong>{{ number_format($totalconsumo, 3) }}</strong></td>
			<td style="text-alight: right;"><strong>{{ number_format($totalliquidado, 3) }}</strong></td>
			<td style="text-alight: right;"><strong>{{ number_format($totalsaldo, 3) }}</strong></td>
			<td style="text-alight: right;">&nbsp;</td>
		</tr>
	</tfoot>
</table>