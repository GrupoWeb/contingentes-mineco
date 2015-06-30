<?php ini_set('max_execution_time', 300); ?>
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

	.border {
		border: 1px solid black;
	}
</style>

<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<tr>
		<th rowspan="2">DACE - MINECO</th>
		<th colspan="3" class="text-center"><h4>{{$titulo}}</h4></th>
	</tr>
	<tr>
		<th>{{ $tratado }}</th>
		<th>{{ $producto }}</th>
		<th>Reporte generado {{ date('d/m/Y') }}</th>
	</tr>
</table>
<br /><br /><br />
<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
	<thead>
		<tr>
			<th class="bold">Fecha</th>
			<th class="bold">Acreditado a</th>
			<th class="bold">Acreditado por</th>
			<th class="bold">Comentario</th>
			<th class="bold">Certificado</th>
			<th class="bold">Crédito</th>
			<th class="bold">Débito</th>
			<th class="bold">Saldo</th>
		</tr>
	</thead>
	<tbody>
		<?php $saldo=0; $debitot=0; $creditot=0; ?>
		@foreach($movimientos as $movimiento)
			<?php 
				$saldo += (float)$movimiento->credito-(float)$movimiento->debito; 
				$debitot += (float)$movimiento->debito;
				$creditot += (float)$movimiento->credito;
			?>
			<tr>
				<td>{{ $movimiento->fecha }}</td>
				<td>{{ $movimiento->acreditadoa }}</td>
				<td>{{ $movimiento->acreditadopor }}</td>
				<td>{{ $movimiento->comentario }}</td>
				<td align="right">{{ $movimiento->certificadoid }}</td>
				<td align="right">{{ $movimiento->credito ? number_format($movimiento->credito, 2) : '&nbsp;' }}</td>
				<td align="right">{{ $movimiento->debito  ? number_format($movimiento->debito, 2) : '&nbsp;' }}</td>
				<td align="right">{{ number_format($saldo, 2) }}</td>
			</tr>
		@endforeach	
		<tfoot>
			<tr>
				<td colspan="5">&nbsp;</td>
				<td align="right"><strong>{{ number_format($creditot,2) }}</strong></td>
				<td align="right"><strong>{{ number_format($debitot,2) }}</strong></td>
				<td align="right"><strong>{{ number_format($saldo, 2) }}</strong></td>
			</tr>
		</tfoot>	
	</tbody>
</table>