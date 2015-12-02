@extends('template/reporte')

@section('content')
	<?php
		$collogo=1; $coltitulo=1; $colsubtitulo=1; $colempresa=1; $coltotal=3;
		switch (count($campos)) {
			case 0:
				$colempresa=2;$coltitulo=3;$coltotal=3;
				break;

			case 1:
				$coltitulo=3;$coltotal=3;
				break;

			case 2:
				$coltitulo=3;$coltotal=4;$collogo=2;
				break;

			case 3:
				$coltitulo=3;$coltotal=5;$collogo=3;
				break;

			case 4:
				$coltitulo=3;$coltotal=6;$collogo=4;
				break;

			case 5:
				$coltitulo=6;$coltotal=7;$collogo=2;$colsubtitulo=2;
				break;

			case 6:
				$coltitulo=6;$coltotal=8;$collogo=3;$colsubtitulo=2;
				break;
		}
	?>

	<table class="table table-striped table-bordered table-condensed blue">
		<thead>
			<tr>
				<th rowspan="2" colspan="{{ $collogo }}" class="text-center bg-white">
					@if($formato <> 'excel') 
						{{ HTML::image('images/logo.jpg') }}
					@endif
					<br>DACE - MINECO
				</th>
				<th colspan="{{ $coltitulo }}" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
			</tr>
			<tr>
				<th colspan="{{ $colsubtitulo }}" class="text-center bg-white">{{ $tratado }}</th>
				<th colspan="{{ $colsubtitulo }}" class="text-center bg-white">{{ $producto }}</th>
				<th colspan="{{ $colsubtitulo }}" class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
			</tr>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center" colspan="{{ $colempresa }}">Empresa</th>
				@foreach($campos as $campo)
					@if($campo == 0)
						<th class="text-center">NIT</th>
					@elseif($campo == 1)
						<th class="text-center">Teléfono</th>
					@elseif($campo == 2)
						<th class="text-center">Email</th>
					@elseif($campo == 3)
						<th class="text-center">Domicilio Fiscal</th>
					@elseif($campo == 4)
						<th class="text-center">Representante Legal</th>
					@elseif($campo == 5)
						<th class="text-center">Encargado</th>
					@endif
				@endforeach
				<th class="text-center">Certificados</th>
			</tr>
		</thead>
		<tbody>
			<?php $total = 0; $i = 1; ?>
			@foreach($certificados as $certificado)
				<tr>
					<td class="text-left">{{ number_format($i) }}</td>
					<td class="text-left" colspan="{{ $colempresa }}">{{ $certificado->nombre }}</td>
					@foreach($campos as $campo)
						@if($campo == 0)
							<td class="text-left">{{ $certificado->nit }}</td>
						@elseif($campo == 1)
							<td class="text-left">{{ $certificado->telefono }}</td>
						@elseif($campo == 2)
							<td class="text-left">{{ $certificado->email }}</td>
						@elseif($campo == 3)	
							<td class="text-left">{{ $certificado->domiciliofiscal }}</td>
						@elseif($campo == 4)	
							<td class="text-left">{{ $certificado->propietario }}</td>
						@elseif($campo == 5)
							<td class="text-left">{{ $certificado->encargado }}</td>
						@endif
					@endforeach
					<td class="text-right">{{ number_format($certificado->cuenta) }}</td>
				</tr>
				<?php $total += $certificado->cuenta; $i++; ?>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td class="text-left text-primary" colspan="{{ $coltotal }}"><strong>TOTAL</strong></td>
				<td class="text-right text-primary"><strong>{{ number_format($total) }}</strong></td>
			</tr>
		</tfoot>
	</table>
@stop