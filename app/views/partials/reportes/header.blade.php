<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th rowspan="2" class="text-center" width="10%">
				{{ HTML::image('images/logo.jpg') }}
				<br>DACE - MINECO
			</th>
			<th colspan="3" class="text-center"><h4>{{$titulo}}</h4></th>
		</tr>
		<tr>
			<th width="30%">{{ $tratado }}</th>
			<th width="30%">{{ $producto }}</th>
			<th width="30%">Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
	</thead>
</table>