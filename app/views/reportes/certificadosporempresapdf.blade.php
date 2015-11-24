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
	<thead>
		<tr>
			<th rowspan="2" colspan="2" style="text-align:center">
				{{ HTML::image('images/logo.jpg') }}
				<br>DACE - MINECO
			</th>
			<th rowspan="1" colspan="3" style="text-align:center"><h4>{{$titulo}}</h4></th>				
		</tr>
		<tr>
			<th rowspan="1" style="text-align:center">{{ $tratado }}</th>
			<th rowspan="1" style="text-align:center">{{ $producto }}</th>
			<th rowspan="1" style="text-align:center">Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
		<tr>
			<th style="text-align:center">Nombre</th>
			<th style="text-align:center">NIT</th>
			<th style="text-align:center">Encargado</th>
			<th style="text-align:center">Teléfono</th>
			<th style="text-align:center">Certificados</th>
		</tr>
	</thead>
	<tbody>
		<?php $total = 0; ?>
		@foreach($certificados as $certificado)
			<tr>
				<td>{{ $certificado->nombre }}</td>
				<td>{{ $certificado->nit }}</td>
				<td>{{ $certificado->encargado }}</td>
				<td>{{ $certificado->telefono }}</td>
				<td style="text-align:right">{{ number_format($certificado->cuenta) }}</td>
			</tr>
			<?php $total += $certificado->cuenta; ?>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"><strong>TOTAL</strong></td>
			<td style="text-align:right"><strong>{{ number_format($total) }}</strong></td>
		</tr>
	</tfoot>
</table>