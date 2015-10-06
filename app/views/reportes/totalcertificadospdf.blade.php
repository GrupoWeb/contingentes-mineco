<style type="text/css">
	table, th, td {
    border: 1px solid #dfdfdf;
	}
</style>

<table cellspacing="0" cellpadding="2" style="font-family:'helvetica';">
	<thead>
		<tr>
			<th rowspan="2" align="center">
				@if($formato <> 'excel') 
					{{ HTML::image('images/logo.jpg') }}
				@endif
				<br>DACE - MINECO
			</th>
			<th rowspan="1" colspan="3" align="center"><h4>{{$titulo}}</h4></th>				
		</tr>
		<tr>
			<th rowspan="1" colspan="3" align="center">Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
	</thead>
</table>
<?php 
	$tcertificados 	= 0;
	$tcontingentes 	= 0;
	$ttratados 			= 0; 
?>
@foreach($datos as $tratados)
		<table cellspacing="0" cellpadding="2"   style="font-family:'helvetica';">
			<thead>
				<tr>
					<th colspan="2" align="center">Tratado {{$tratados[0]}}</th>
					<?php $ttratados++; ?>
				</tr>
			</thead>
		</table>
		@foreach($tratados[1] as $value)
			<table cellpadding="2" cellspacing="0"  style="font-family:'helvetica';">
				<thead>
					<tr>
						<th colspan="2" align="center">Contingente {{$value[0]->producto}}</th>
						<?php $tcontingentes++; ?>
					</tr>
					<tr>
						<th width="50%" align="center">Empresa</th>
						<th width="50%" align="center">Certificados</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($value[1]))
						@foreach($value[1] as $tbody)
							<tr>
								<td align="center" style="font-size: 8px">{{$tbody->nombre}}</td>
								<td align="center" style="font-size: 8px">{{$tbody->numerocertificado}}</td>
							</tr>
							<?php $tcertificados++; ?>
						@endforeach
					@else
						<tr>
							<td colspan="2" align="center">No se encontraron certificados</td>
						</tr>
					@endif
				</tbody>
			</table>
		@endforeach
@endforeach
<br><br><br>
<table style="font-family:'helvetica';">
	<tr>
		<td width="50%">Total de Certificados</td>
		<td width="50%">{{$tcertificados}}</td>
	</tr>
	<tr>
		<td width="50%">Total de Contingentes</td>
		<td width="50%">{{$tcontingentes}}</td>
	</tr>
		<tr>
		<td width="50%">Total de Tratados</td>
		<td width="50%">{{$ttratados}}</td>
	</tr>
</table>