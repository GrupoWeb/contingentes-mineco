@extends('template/reporte')

@section('content')
	@include('partials/reportes/header')

	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th class="text-center">Fecha Inscripción</th>
				<th class="text-center">Nombre</th>
				<th class="text-center">Producto</th>
				<th class="text-center">Tratado</th>

			</tr>
		</thead>
		<tbody>
			
			@foreach($datos as $d)
				<tr>
					<td>{{ $d->fecha }}</td>
					<td>{{ $d->nombre }}</td>
					<td>{{ $d->producto }}</td>
					<td>{{ $d->tratado }}</td>

				</tr>
			@endforeach		
		</tbody>
	</table>
@stop