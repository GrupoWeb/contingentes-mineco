@extends('template/reporte')
@section('content')

	<?php 
		$acreditadoLast = '__Primero__';
		$saldo=0; $debitot=0; $creditot=0; 
	?>

		<table class="table table-striped table-bordered blue">
			<thead>
				<tr>
					<th rowspan="2" colspan="2" class="text-center bg-white">
						@if($formato <> 'excel') 
							{{ HTML::image('images/logo.jpg') }}
						@endif
						<br>DACE - MINECO
					</th>
					<th rowspan="1" colspan="5" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
				</tr>

				<tr>
					<th rowspan="1" colspan="1" class="text-center bg-white">{{ $tratado }}</th>
					<th rowspan="1" colspan="2" class="text-center bg-white">{{ $producto }}</th>
					<th rowspan="1" colspan="2" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
				</tr>

				<tr>
					<th style="vertical-align: middle;" class="text-center">Fecha</th>
					<th style="vertical-align: middle;" class="text-center">Acreditado por</th>
					<th style="vertical-align: middle;" class="text-center">Comentario</th>
					<th style="vertical-align: middle;" class="text-center">Certificado</th>
					<th style="vertical-align: middle;" class="text-center">Crédito</th>
					<th style="vertical-align: middle;" class="text-center">Débito</th>
					@if($asignacion)
						<th style="vertical-align: middle;" class="text-center">Saldo</th>
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
						<td class="text-center">{{ $dato['certificado'] }}</td>
						<td class="text-center">{{ number_format($dato['credito'], 2) }}</td>
						<td class="text-center">{{ number_format($dato['debito'], 2) }}</td>
						@if($asignacion)
							<?php 
								$saldo = $sumsaldo + (float)$dato['credito'] - (float)$dato['debito']; 
							?>
							<td class="text-center">{{ number_format($saldo, 2) }}</td>
						@endif
					</tr>
					<?php $sumcredito+=$dato['credito']; $sumdebito+=$dato['debito']; $sumsaldo=$saldo; ?>
				@endforeach
				<tr>
					<td colspan="4">&nbsp;</td>
					<td class="text-center text-primary">{{ number_format($sumcredito, 2) }}</td>
					<td class="text-center text-primary">{{ number_format($sumdebito, 2) }}</td>
					@if($asignacion)
						<td class="text-center text-primary">{{ number_format($saldo, 2) }}</td>
					@endif
				</tr>
			@endforeach
		</tbody>
		</table>

@stop