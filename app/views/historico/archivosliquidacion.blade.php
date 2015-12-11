@extends('template.template')

@section('content')
	<h3 class="text-primary">{{ $titulo }}</h3>
	@if($solicitud)
		<dl class="dl-horizontal">
		  <dt>Nombre</dt>
		  <dd>{{ $solicitud->nombre }}</dd>
		  <dt>Empresa</dt>
		  <dd>{{ $solicitud->razonsocial }}</dd>
		  <dt>NIT</dt>
		  <dd>{{ $solicitud->nit }}</dd>
		  <dt>Estado</dt>
		  <dd>{{ $solicitud->estado }}</dd>
		  <dt>Fecha solicitud</dt>
		  <dd>{{ $solicitud->fecha }}</dd>
		  <dt>Observaciones</dt>
		  <dd>{{ $solicitud->observaciones }}</dd>
		</dl>
	@endif
	
	<h4>Archivos</h4>
	<ul class="list-group">
			<li class="list-group-item">
				<a target="_blank" href="/archivos/liquidaciones/{{$solicitud->usuarioid . '/' . $solicitud->documento}}">{{ $solicitud->documento }}</a>
			</li>
	</ul>
@stop