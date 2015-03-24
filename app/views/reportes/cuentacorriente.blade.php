@extends('template/reporte')

@section('content')
	@include('partials/reportes/header')

	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th class="text-center">Fecha</th>
				<th class="text-center">Acreditado a</th>
				<th class="text-center">Acreditado por</th>
				<th class="text-center">Comentario</th>
				<th class="text-center">Certificado</th>
				<th class="text-center">Crédito</th>
				<th class="text-center">Débito</th>
				<th class="text-center">Saldo</th>
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
					<td class="text-right">{{ $movimiento->certificadoid }}</td>
					<td class="text-right">{{ $movimiento->credito ? number_format($movimiento->credito, 2) : '&nbsp;' }}</td>
					<td class="text-right">{{ $movimiento->debito  ? number_format($movimiento->debito, 2) : '&nbsp;' }}</td>
					<td class="text-right">{{ number_format($saldo, 2) }}</td>
				</tr>
			@endforeach	
			<tfoot>
				<tr>
					<td colspan="5">&nbsp;</td>
					<td class="text-right text-primary">{{number_format($creditot,2)}}</td>
					<td class="text-right text-primary">{{number_format($debitot,2)}}</td>
					<td class="text-right text-primary">{{ number_format($saldo, 2) }}</td>
				</tr>
			</tfoot>	
		</tbody>
	</table>
@stop