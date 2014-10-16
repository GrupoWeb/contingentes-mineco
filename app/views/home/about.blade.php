@extends('template/template')

@section('content')
	<style>
    .cntr{
      text-align: center;
    }
  </style>
	<div class="jumbotron">
		<h2>Sobre Aplicacion</h2>
			<hr>
			<div class="cntr">
				<h4>Aplicaci&oacute;n desarrollada por Compuservice Webdessigns &reg;</h4>
				{{HTML::image('images/logo-cs.png')}}
				<address>
				  22 ave. B 0-51B z.15<br>
				  Vista Hermosa II<br>
				  Guatemala, Guatemala <br><br>
				  <abbr title="Telefono">T:</abbr> (+502) 2369.5718<br>
				  <abbr title="Telefono">T:</abbr> (+502) 2365.6429<br><br>
				  <a href="mailto:info@cs.com.gt">info@cs.com.gt</a><br>
				  <a href="cs.com.gt">www.cs.com.gt</a>
				</address>
			</div>
		<div class="clearfix"></div>
	</div>
@stop