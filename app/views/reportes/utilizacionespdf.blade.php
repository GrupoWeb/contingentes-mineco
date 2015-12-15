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
<table width="100%" cellpadding="2" style="font-size: 8px; line-height: 7px" border="1">
	<thead>
		<tr>
			<th rowspan="2" colspan="5" style="text-align:center;"><img src="{{ public_path() }}/images/logo-menu.png"></th>
			<th colspan="9" style="text-align:center;"><h4>{{$titulo}}</h4></th>
		</tr>
		<tr>
			<th colspan="3" style="text-align:center;" {{($esasignacion==1)? 'width="18%"':''}}>{{ $tratado }}</th>
			<th colspan="3" style="text-align:center;"{{($esasignacion==1)? 'width="26%"':''}}>{{ $producto }}</th>
			<th colspan="3" style="text-align:center;" {{($esasignacion==1)? 'width="20%"':''}}>Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
		<tr>
			<th rowspan="2" style="text-align: center;">NIT</th>
			<th rowspan="2" style="text-align: center;">Importador</th>
			@if($esasignacion==1)
				<th rowspan="2" style="text-align: center;">Asignado</th>
				<th rowspan="2" style="text-align: center;">Adjudicado</th>
				<th rowspan="2" style="text-align: center;">Saldo</th>
			@else
				<th colspan="3">Adjudicado</th>
			@endif
			
			<th colspan="3" style="text-align: center;" {{($esasignacion==1)? 'width="18%"':''}}>Volúmen</th>
			<th colspan="5" style="text-align: center;"{{($esasignacion==1)? 'width="26%"':''}}>Adjudicado</th>
			<th style="text-align: center;"{{($esasignacion==1)? 'width="20%"':''}}>Liquidado</th>
		</tr>
		@if($esasignacion==1)
			<tr>
				<th width="6%" style="text-align: center;">No.</th>
				<th width="6%" style="text-align: center;">Fecha</th>
				<th width="6%" style="text-align: center;">Fracción</th>
				<th width="6%" style="text-align: center; font-size:8px;">Venicimiento</th>
				<th width="5%" style="text-align: center;">TM</th>
				<th width="5%" style="text-align: center;">Fecha</th>
				<th width="5%" style="text-align: center;">DUA</th>
				<th width="5%" style="text-align: center;">TM</th>
				<th width="5%" style="text-align: center;">Variación</th>
				<th width="5%" style="text-align: center;">%</th>
				<th width="5%" style="text-align: center;">CIF</th>
				<th width="5%" style="text-align: center;">$/TM</th>
			</tr>
		@else
		<tr>
				<th style="text-align: center;">No.</th>
				<th style="text-align: center;">Fecha</th>
				<th style="text-align: center;">Fracción</th>
				<th style="text-align: center;">Venicimiento</th>
				<th style="text-align: center;">TM</th>
				<th style="text-align: center;">Fecha</th>
				<th style="text-align: center;">DUA</th>
				<th style="text-align: center;">TM</th>
				<th style="text-align: center;">Variación</th>
				<th style="text-align: center;">%</th>
				<th style="text-align: center;">CIF</th>
				<th style="text-align: center;">$/TM</th>
			</tr>
		@endif
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
						<td {{($esasignacion==1)? 'width="6%"':''}}>{{ $movimiento['certificado']  }}</td>
						<td {{($esasignacion==1)? 'width="6%"':''}}>{{ $movimiento['fecha'] }}</td>
						<td {{($esasignacion==1)? 'width="6%"':''}}>{{ $movimiento['fraccion'] }}</td>
						<td {{($esasignacion==1)? 'width="6%"':''}}>{{ $movimiento['fechavencimiento'] }}</td>
						<td {{($esasignacion==1)? 'width="5%"':''}} class="right">{{ number_format($movimiento['cantidad'], 3) }}</td>
						@if($movimiento['dua'] <> '')
							<td>{{ $movimiento['fechaliquidacion'] }}</td>
							<td>{{ $movimiento['dua'] }}</td>
							<td>{{ number_format($movimiento['real'], 3) }}</td>
							<td>{{ $movimiento['variacion'] }}</td>
							<td>{{ number_format((($movimiento['real'] * 100)/$movimiento['cantidad']), 2) }}</td>
							<td>{{ number_format($movimiento['cif'], 2) }}</td>
							<td>{{ $movimiento['real'] <> 0 ? (number_format(($movimiento['cif']/$movimiento['real']), 2)) : '0.00' }}</td>
						@else
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
							<td {{($esasignacion==1)? 'width="5%"':''}}>&nbsp;</td>
						@endif
					</tr>
					<?php $i++; ?>
				@endforeach
		@endforeach
	@endforeach
	</tbody>
</table>
<br /><br /><br />
<table width="50%" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<td>Cuota total Contingente</td>
		<td class="right"><strong>{{ number_format($volumentotalt, 3) }}</strong></td>
	</tr>
	@if($esasignacion==1)
	<tr>
		<td>Pendiente por asignar</td>
		<td class="right"><strong>{{ number_format($asignadot, 3) }}</strong></td>
	</tr>
	@endif
	<tr>
		<td>Adjudicado en Certificados</td>
		<td class="right"><strong>{{ number_format($adjudicadot, 3) }}</strong></td>
	</tr>
	@if($esasignacion==1)
	<tr>
		<td>Pendiente por adjudicar</td>
		<td class="right"><strong>{{ number_format($asignadot-$adjudicadot, 3) }}</strong></td>
	</tr>
	@else
	<tr>
		<td>Saldo</td>
		<td class="right"><strong>{{ number_format($volumentotalt-$adjudicadot, 3) }}</strong></td>
	</tr>
	@endif
</table>