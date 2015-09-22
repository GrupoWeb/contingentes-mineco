@extends('template/reporte')
@section('content')

	<table class="table table-striped table-bordered blue">
		<thead>
			<tr>
				<th rowspan="2" colspan="2" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th rowspan="1" colspan="6" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>

			<tr>
				<th rowspan="1" colspan="2" class="text-center bg-white">{{ $tratado }}</th>
				<th rowspan="1" colspan="2" class="text-center bg-white">{{ $producto }}</th>
				<th rowspan="1" colspan="2" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>

			<tr>
				<th style="vertical-align: middle;" class="text-center">Fecha</th>
				<th style="vertical-align: middle;" class="text-center">Acreditado a</th>
				<th style="vertical-align: middle;" class="text-center">Acreditado por</th>
				<th style="vertical-align: middle;" class="text-center">Comentario</th>
				<th style="vertical-align: middle;" class="text-center">Certificado</th>
				<th style="vertical-align: middle;" class="text-center">Crédito</th>
				<th style="vertical-align: middle;" class="text-center">Débito</th>
				<th style="vertical-align: middle;" class="text-center">Saldo</th>
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
					<td class="text-center">{{ $movimiento->certificadoid }}</td>
					<td class="text-center">{{ $movimiento->credito ? number_format($movimiento->credito, 2) : '&nbsp;' }}</td>
					<td class="text-center">{{ $movimiento->debito  ? number_format($movimiento->debito, 2) : '&nbsp;' }}</td>
					<td class="text-center">{{ number_format($saldo, 2) }}</td>
				</tr>
			@endforeach	
			<tbody>
				<tr>
					<td colspan="5">&nbsp;</td>
					<td class="text-center text-primary">{{number_format($creditot,2)}}</td>
					<td class="text-center text-primary">{{number_format($debitot,2)}}</td>
					<td class="text-center text-primary">{{ number_format($saldo, 2) }}</td>
				</tr>
			</tbody>	
		</tbody>
	</table>
@stop