@extends('template.template')

@section('content')
	<h3 class="text-primary">Noticias</h3>
	<hr />
	@foreach($noticias as $noticia)
		<div class="media">
		  <div class="media-body">
		    <h4 class="media-heading">{{ $noticia->titulo.' ('.$noticia->fecha.')' }}</h4>
		    
		    @if($noticia->imagen<>null)
					<p class="text-center"><img class="media-object" src="/noticias/{{ $noticia->imagen }}"></p>
		    @endif
		    
		    <p class="text-justify">{{ $noticia->contenido }}</p>
		    
		    @if($noticia->documento<>null)
			    <div class="list-group col-sm-3 text-center">
					  <a href="/noticias/documentos/{{ $noticia->documento }}" class="list-group-item" target="on_black">
					  	Descargar documento adjunto
					  </a>
					</div>
				@endif
		  </div>
		</div>
		<hr />
	@endforeach
@stop