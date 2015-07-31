@extends('template/reporte')

@section('content')
	<?php 
		$acreditadoLast = '__Primero__';
		$saldo=0; $debitot=0; $creditot=0; 
	?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th class="text-center">Fecha</th>
				<th class="text-center">Acreditado por</th>
				<th class="text-center">Comentario</th>
				<th class="text-center">Certificado</th>
				<th class="text-center">Crédito</th>
				<th class="text-center">Débito</th>
				@if($asignacion)
					<th class="text-center">Saldo</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@foreach($movimientos as $empresa=>$datos)
				<tr>
					<td colspan="{{ $asignacion ? '7' : '6' }}" class="text-primary"><strong>{{ $empresa }}</strong></td>
				</tr>
				<?php $sumcredito=0; $sumdebito=0; $sumsaldo=0; ?>
				@foreach($datos as $dato)
					<tr>
						<td>{{ $dato['fecha'] }}</td>
						<td>{{ $dato['acreditadopor'] }}</td>
						<td>{{ $dato['comentario'] }}</td>
						<td class="text-right">{{ $dato['certificado'] }}</td>
						<td class="text-right">{{ number_format($dato['credito'], 2) }}</td>
						<td class="text-right">{{ number_format($dato['debito'], 2) }}</td>
						@if($asignacion)
							<?php 
								$saldo = $sumsaldo + (float)$dato['credito'] - (float)$dato['debito']; 
							?>
							<td class="text-right">{{ number_format($saldo, 2) }}</td>
						@endif
					</tr>
					<?php $sumcredito+=$dato['credito']; $sumdebito+=$dato['debito']; $sumsaldo=$saldo; ?>
				@endforeach
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="text-right text-primary">{{ number_format($sumcredito, 2) }}</td>
					<td class="text-right text-primary">{{ number_format($sumdebito, 2) }}</td>
					@if($asignacion)
						<td class="text-right text-primary">{{ number_format($saldo, 2) }}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>














	
@stop