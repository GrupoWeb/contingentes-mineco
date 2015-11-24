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
				<th rowspan="1" colspan="3" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>
			<tr>
				<th rowspan="1" class="text-center bg-white">{{ $tratado }}</th>
				<th rowspan="1" class="text-center bg-white">{{ $producto }}</th>
				<th rowspan="1" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>
			<tr>
				<th style="vertical-align: middle;" class="text-center">Nombre</th>
				<th style="vertical-align: middle;" class="text-center">NIT</th>
				<th style="vertical-align: middle;" class="text-center">Encargado</th>
				<th style="vertical-align: middle;" class="text-center">Teléfono</th>
				<th style="vertical-align: middle;" class="text-center">Certificados</th>
			</tr>
		</thead>
		<tbody>
			<?php $total = 0; ?>
			@foreach($certificados as $certificado)
				<tr>
					<td class="text-left">{{ $certificado->nombre }}</td>
					<td class="text-left">{{ $certificado->nit }}</td>
					<td class="text-left">{{ $certificado->encargado }}</td>
					<td class="text-left">{{ $certificado->telefono }}</td>
					<td class="text-right">{{ number_format($certificado->cuenta) }}</td>
				</tr>
				<?php $total += $certificado->cuenta; ?>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td class="text-left" colspan="4"><strong>TOTAL</strong></td>
				<td class="text-right"><strong>{{ number_format($total) }}</strong></td>
			</tr>
		</tfoot>
	</table>
@stop