<style>
	.size14 {
		font-size: 14px;
	}

	.size12 {
		font-size: 12px;
	}

	.size6 {
		font-size: 6px;
	}

	.underline {
		text-decoration: underline;
	}

	.italics {
		font-style: italic;
	}

	.bold {
		font-style: bold;
	}

	.center {
		text-align: center;
	}

	.right {
		text-align: right;
	}

	.border {
		border: 1px solid black;
	}
</style>
<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<th rowspan="2">DACE - MINECO</th>
		<th colspan="3" class="center"><h4>{{$titulo}}</h4></th>
	</tr>
	<tr>
		<th>{{ $tratado }}</th>
		<th>{{ $producto }}</th>
		<th>Reporte generado {{ date('d/m/Y') }}</th>
	</tr>
</table>
<br /><br /><br />
<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<th rowspan="2">NIT</th>
		<th rowspan="2">Importador</th>
		<th colspan="3" class="center">Volúmen</th>
		<th colspan="5" class="center">Adjudicado</th>
		<th colspan="7" class="center">Liquidado</th>
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
					<td rowspan="{{ $cuantos }}" class="right">{{ number_format($movimientos['asignado'], 3) }}</td>
					<td rowspan="{{ $cuantos }}" class="right">{{ number_format($movimientos['adjudicado'], 3) }}</td>
					<td rowspan="{{ $cuantos }}" class="right">{{ number_format($movimientos['asignado']-$movimientos['adjudicado'], 3) }}</td>
				@else
					<td rowspan="{{ $cuantos }}" colspan="3" class="right" style="vertical-align: middle;">{{ number_format($movimientos['adjudicado'], 3) }}</td>
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
						<td>{{ $movimiento['certificado']  }}</td>
						<td>{{ $movimiento['fecha'] }}</td>
						<td>{{ $movimiento['fraccion'] }}</td>
						<td>{{ $movimiento['fechavencimiento'] }}</td>
						<td class="right">{{ number_format($movimiento['cantidad'], 3) }}</td>
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
</table>
<br /><br /><br />
<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<td>Cuota total</td>
		<td class="right"><strong>{{ number_format($volumentotalt, 3) }}</strong></td>
	</tr>
	@if($esasignacion==1)
	<tr>
		<td>Asignado</td>
		<td class="right"><strong>{{ number_format($asignadot, 3) }}</strong></td>
	</tr>
	@endif
	<tr>
		<td>Adjudicado</td>
		<td class="right"><strong>{{ number_format($adjudicadot, 3) }}</strong></td>
	</tr>
	@if($esasignacion==1)
	<tr>
		<td>Saldo</td>
		<td class="right"><strong>{{ number_format($asignadot-$adjudicadot, 3) }}</strong></td>
	</tr>
	@else
	<tr>
		<td>Saldo</td>
		<td class="right"><strong>{{ number_format($volumentotalt-$adjudicadot, 3) }}</strong></td>
	</tr>
	@endif
</table>