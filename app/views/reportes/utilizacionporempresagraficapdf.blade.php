<table width="100%" cellpadding="3" style="font-size: 9px; line-height: 12px" border="1">
	<thead>
		<tr>
			<th rowspan="2" colspan="2" style="text-align:center;"><img src="{{ public_path() }}/images/logo-menu.png"></th>
			<th colspan="4" style="text-align:center;"><h4>{{$titulo}}</h4></th>
		</tr>
		<tr>
			<th colspan="2" style="text-align:center;">{{ $tratado }}</th>
			<th style="text-align:center;">{{ $producto }}</th>
			<th style="text-align:center;">Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
	</thead>
</table>