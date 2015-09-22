@extends('template/template')

@section('content')
	{{ HTML::style('http://fonts.googleapis.com/css?family=Archivo+Narrow|Raleway:400,700') }}
	{{ HTML::style('css/dace.css') }}

	<h1 class="titulo">Empresas inscritas</h1>

	@foreach($datos as $tratado => $contingentes)
		<h4 class="titulo">{{ $tratado }}</h4>
		
		<table class="table table-striped table-bordered blue">
	  	<thead class="">
	  		<th>Nombre</th>
	  		<th>NIT</th>
	  		<th>Domicilio comercial</th>
	  		<th>Teléfono</th>
	  		<th>Fecha inscripción</th>
	  	</thead>
			@foreach($contingentes as $contingente => $empresas)
					<td colspan="4"><strong>{{ $contingente }}</strong></td>
					@foreach($empresas['empresas'] as $empresa)				
				  	<tbody>
				  		<td>{{ $empresa['empresa'] }}</td>
				  		<td>{{ $empresa['nit'] }}</td>
				  		<td>{{ $empresa['domiciliocomercial'] }}</td>
				  		<td class="text-center">{{ $empresa['telefono'] }}</td>
				  		<td class="text-center">{{ $empresa['fechainscripcion'] }}</td>
				  	</tbody>
					@endforeach
						<tr>
							<td colspan="4" class="text-center"><strong>TOTAL</strong></td>
							<td class="text-center"><strong>{{ number_format(count($empresas['empresas'])) }}</strong></td>
						</tr>
			@endforeach
		</table>
	@endforeach
@stop