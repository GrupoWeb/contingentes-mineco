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
<br />

<?php $acreditadoLast = '__Primero__'; ?>
@foreach($movimientos as $movimiento)
	@if($movimiento->acreditadoa<>$acreditadoLast)
		@if($acreditadoLast<>'__Primero__')
			</tbody>
				<tfoot>
					<tr>
						<td colspan="4">&nbsp;</td>
						<td class="text-right text-primary">{{number_format($creditot,2)}}</td>
						<td class="text-right text-primary">{{number_format($debitot,2)}}</td>
						<td class="text-right text-primary">{{ number_format($saldo, 2) }}</td>
					</tr>
				</tfoot>	
			</table>
		@endif
		<?php $saldo=0; $debitot=0; $creditot=0; ?>
		<h6>{{ $movimiento->acreditadoa }}</h6>
		<table width="500" cellpadding="3" style="font-size: 8px; line-height: 7px" border="1">
			<thead>
				<tr>
					<th class="bold">Fecha</th>
					<th class="bold">Acreditado por</th>
					<th class="bold">Comentario</th>
					<th class="bold">Certificado</th>
					<th class="bold">Crédito</th>
					<th class="bold">Débito</th>
					<th class="bold">Saldo</th>
				</tr>
			</thead>
			<tbody>
	@endif
	<?php 
		$creditot += (float)$movimiento->credito;
		$debitot  += (float)$movimiento->debito;
		$saldo    += (float)$movimiento->credito-(float)$movimiento->debito; 
	?>
	<tr>
		<td>{{ $movimiento->fecha }}</td>
		<td>{{ $movimiento->acreditadopor }}</td>
		<td>{{ $movimiento->comentario }}</td>
		<td class="text-right">{{ $movimiento->certificadoid }}</td>
		<td class="text-right">{{ $movimiento->credito ? number_format($movimiento->credito, 2) : '&nbsp;' }}</td>
		<td class="text-right">{{ $movimiento->debito  ? number_format($movimiento->debito, 2) : '&nbsp;' }}</td>
		<td class="text-right">{{ number_format($saldo, 2) }}</td>
	</tr>
	<?php $acreditadoLast = $movimiento->acreditadoa; ?>
@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">&nbsp;</td>
			<td class="text-right text-primary">{{number_format($creditot,2)}}</td>
			<td class="text-right text-primary">{{number_format($debitot,2)}}</td>
			<td class="text-right text-primary">{{ number_format($saldo, 2) }}</td>
		</tr>
	</tfoot>	
</table>