@extends('template.template')

@section('content')
	<h3 class="text-primary">{{ $titulo }}</h3>
	@if($solicitud)
		<dl class="dl-horizontal">
		  <dt>Nombre</dt>
		  <dd>{{ $solicitud->nombre }}</dd>
		  <dt>Email</dt>
		  <dd>{{ $solicitud->email }}</dd>
		  <dt>Tratado</dt>
		  <dd>{{ $solicitud->tratado }}</dd>
		  <dt>Estado</dt>
		  <dd>{{ $solicitud->estado }}</dd>
		  <dt>Fecha solicitud</dt>
		  <dd>{{ $solicitud->fecha }}</dd>
		</dl>
	@endif
	
	<h4>Archivos</h4>
	<ul class="list-group">
		@foreach($archivos as $archivo)
			<li class="list-group-item">
				<a target="_blank" href="/archivos/{{$archivo->usuarioid. '/' . $archivo->archivo}}">{{ $archivo->nombre }}</a>
			</li>
		@endforeach
	</ul>
@stop