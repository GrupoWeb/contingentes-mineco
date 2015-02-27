@extends('template/template')

@section('content')
	{{ HTML::style('http://fonts.googleapis.com/css?family=Archivo+Narrow|Raleway:400,700') }}
	{{ HTML::style('css/dace.css') }}

	<h1 class="titulo">Empresas inscritas</h1>

	@foreach($datos as $tratado => $contingentes)
		<h4 class="titulo">{{ $tratado }}</h4>
		
		<table class="table table-bordered table-condensed">
	  	<thead>
	  		<th>Nombre</th>
	  		<th>Email</th>
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
				  		<td>{{ $empresa['email'] }}</td>
				  		<td>{{ $empresa['nit'] }}</td>
				  		<td>{{ $empresa['domiciliocomercial'] }}</td>
				  		<td class="text-right">{{ $empresa['telefono'] }}</td>
				  		<td class="text-right">{{ $empresa['fechainscripcion'] }}</td>
				  	</tbody>
					@endforeach
						<tr>
							<td colspan="5" class="text-right"><strong>TOTAL</strong></td>
							<td class="text-right"><strong>{{ number_format(count($empresas['empresas'])) }}</strong></td>
						</tr>
			@endforeach
		</table>
	@endforeach
@stop