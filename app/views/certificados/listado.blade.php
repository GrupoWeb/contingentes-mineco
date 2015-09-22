@extends('template.template')

@section('content')
	<h3 class="text-primary">Certificados</h3> 
	@if(count($certificados) > 0)
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Fecha</th>
					<th>Nombre</th>
					<th>Volumen</th>
					<th>Liquidado</th>
					<th>Anulado</th>
					<th>Comentario</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($certificados as $numero=>$datos)
					<tr>
						<td>{{ $numero }}</td>
						<td>{{ $datos['fecha'] }}</td>
						<td>{{ $datos['nombre'] }}</td>
						<td class="text-right">{{ number_format($datos['volumen'], 3) }}</td>
						<td class="text-center">
							{{ $datos['liquidado'] == 0 ? '<span class="label label-default" style="display:block; width: 40px; margin: auto;">No</span>' : '<span class="label label-primary" style="display:block; width: 40px; margin: auto;">Si</span>' }}
						</td>
						<td class="text-center">
							{{ $datos['anulado'] == 0 ? '<span class="label label-default" style="display:block; width: 40px; margin: auto;">No</span>' : '<span class="label label-primary" style="display:block; width: 40px; margin: auto;">Si</span>' }}
						</td>
						<td>{{ $datos['comentario'] }}</td>
						<td>
							<?php $id = Crypt::encrypt($datos['certificadoid']); ?>
							<a target="_blank" href="c/{{ $id }}" title="Generar" class="btn btn-xs btn-primary"><span class="fa fa-file-pdf-o"></span></a>
							<a href="certificados/liquidar/{{ $id }}" title="Liquidar" class="btn btn-xs btn-success"><span class="fa fa-check-square "></span></a>
							<a href="certificados/anular/{{ $id }}" title="Anular" class="btn btn-xs btn-danger"><span class="fa fa-minus-square-o"></span></a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>No se encontraron certificados que cumplan con los filtros seleccionados</p>
	@endif
@stop