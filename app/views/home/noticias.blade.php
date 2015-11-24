@extends('template.template')

@section('content')
	@foreach($noticias as $noticia)
		<div class="media">
		  <div class="media-body">
		    <h4 class="media-heading">{{ $noticia->titulo.' ('.$noticia->fecha.')' }}</h4>
		    <p class="text-center"><img class="media-object" src="/noticias/{{ $noticia->imagen }}"></p>
		    <p class="text-justify">{{ $noticia->contenido }}</p>
		  </div>
		</div>
		<hr />
	@endforeach
@stop