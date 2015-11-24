@extends('template/reporte')
@section('content')
	
<table class="table-striped table-bordered blue" cellspacing="0" style="font-family:'helvetica';">
	<thead>
		<tr>
			<th rowspan="2" class="text-center bg-white">
				@if($formato <> 'excel') 
					{{ HTML::image('images/logo.jpg') }}
				@endif
				<br>DACE - MINECO
			</th>
			<th rowspan="1" colspan="3" class="text-center bg-white"><h4>{{$titulo}}</h4></th>				
		</tr>
		<tr>
			<th rowspan="1"  class="text-center bg-white">Reporte generado {{ date('d/m/Y') }}</th>
		</tr>
	</thead>
</table>
<?php 
	$tcertificados 	= 0;
	$tcontingentes 	= 0;
	$ttratados 			= 0; 
?>
@foreach($datos as $tratados)
		<table class="table-striped table-bordered" cellspacing="0" style="font-family:'helvetica';">
			<thead>
				<tr>
					<th colspan="2">Tratado {{$tratados[0]}}</th>
					<?php $ttratados++; ?>
				</tr>
			</thead>
		</table>
		@foreach($tratados[1] as $value)
			<table class="table-striped table-bordered blue" cellspacing="0" style="font-family:'helvetica';">
				<thead>
					<tr>
						<th colspan="2">Contingente {{$value[0]->producto}}</th>
						<?php $tcontingentes++; ?>
					</tr>
					<tr>
						<th width="50%">Empresa</th>
						<th width="50%">Certificados</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($value[1]))
						@foreach($value[1] as $tbody)
							<tr>
								<td class="text-left">{{$tbody->nombre}}</td>
								<td class="textcenter">{{$tbody->numerocertificado}}</td>
							</tr>
							<?php $tcertificados++; ?>
						@endforeach
						<tr>
							<td><strong>TOTAL</strong></td>
							<td><strong></strong></td>
						</tr>
					@else
						<tr>
							<td colspan="2">No se encontraron certificados</td>
						</tr>
					@endif
				</tbody>
			</table>
		@endforeach
@endforeach

<table class="table-striped table-bordered blue" style="font-family:'helvetica';">
	<tr>
		<td width="50%" class="text-right">Total de Certificados</td>
		<td width="50%" class="text-right">{{$tcertificados}}</td>
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