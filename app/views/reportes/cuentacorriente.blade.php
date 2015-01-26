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
				<th class="text-center">Crédito</th>
				<th class="text-center">Débito</th>
				<th class="text-center">Saldo</th>
			</tr>
		</thead>
		<tbody>
			<?php $saldo = 0; ?>
			@foreach($movimientos as $movimiento)
				<?php $saldo += $movimiento->cantidad; ?>
				<tr>
					<td>{{ $movimiento->fecha }}</td>
					<td>{{ $movimiento->acreditadoa }}</td>
					<td>{{ $movimiento->acreditadopor }}</td>
					<td>{{ $movimiento->comentario }}</td>
					<td class="text-right">{{ $movimiento->cantidad > 0 ? number_format($movimiento->cantidad, 2) : '&nbsp;' }}</td>
					<td class="text-right">{{ $movimiento->cantidad < 0 ? number_format($movimiento->cantidad * -1, 2) : '&nbsp;' }}</td>
					<td class="text-right">{{ number_format($saldo, 2) }}</td>
				</tr>
			@endforeach		
		</tbody>
	</table>
@stop