@extends('template.template')

@section('content')
	<h3 class="text-primary">Noticias</h3>

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	<?php $i=0; ?>
	  	@foreach($noticias as $noticia)
				<li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ ($i==0 ? 'active' : '') }}"></li>
				<?php $i++; ?>
			@endforeach
	  </ol>

	  <div class="carousel-inner" role="listbox">
	  	<?php $i=0; ?>
	  	@foreach($noticias as $noticia)
	  		<div class="item {{ ($i==0 ? 'active' : '') }}">
				  <img src="/noticias/{{ $noticia->imagen }}" alt="...">
				  <div class="carousel-caption">
				    <h3>{{ $noticia->titulo.' ('.$noticia->fecha.')' }}</h3>
				    <p>{{ str_limit($noticia->contenido, 200) }}</p>
				    <p><a href="noticas/{{ $noticia->slug }}" target="_blank">Ver más</a></p>
				  </div>
				</div>
				<?php $i++; ?>
			@endforeach
	  </div>

	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	<br /><br /><br />
@stop