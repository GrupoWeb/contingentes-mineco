@extends('template/reporte')

@section('content')
	<?php 
		$acreditadoLast = '__Primero__';
	?>
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
			<h3 class="text-primary">{{ $movimiento->acreditadoa }}</h3>
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th class="text-center">Fecha</th>
						<th class="text-center">Acreditado por</th>
						<th class="text-center">Comentario</th>
						<th class="text-center">Certificado</th>
						<th class="text-center">Crédito</th>
						<th class="text-center">Débito</th>
						<th class="text-center">Saldo</th>
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
@stop