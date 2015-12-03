@extends('template.template')

@section('content')
	<h3 class="text-primary">{{ $noticia->titulo.' ('.$noticia->fecha.')' }}</h3>
	<div class="col-sm-12 text-center"><img src="/noticias/{{ $noticia->imagen }}" alt="..."></div>
	<div class="clearfix"></div><br />
	<p class="text-justify">{{ $noticia->contenido }}</p><br>

	@if($noticia->documento)
		<div class="list-group">
		  <a href="/noticias/documentos/{{ $noticia->documento }}" class="list-group-item" target="_blank">Descargar documento adjunto</a>
		</div>
	@endif
@stop