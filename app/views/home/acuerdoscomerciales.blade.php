@extends('template.home')

@section('content')

	{{ HTML::style('packages/csgt/components/css/font-awesome.min.css'); }}

	<div class="contenido">
    <h1 class="titulo">Acuerdos Comerciales</h1>
    <div class="col-xs-12">
	    <?php $tipoant = 'Primero'; $tratadoant = 'Primero'; ?>
	    @foreach($contingentes as $contingente)

		    @if($contingente->tipo<>$tipoant)
		    	<div class="clearfix"></div>
		    	<div class="col-xs-12">
		    		<h3>{{$contingente->tipo}}</h3>
		    	</div>
		    @endif

		    @if($contingente->tratado<>$tratadoant)
		    	<div class="clearfix"></div>
		    	<div class="col-xs-12">
		    		<h4 class="titulo">{{$contingente->tratado}}</h4>
		    	</div>
		    @endif
		    <div class="col-sm-4 col-titulo-contingente">
		    	<div class="panel panel-default">
					  <div class="panel-heading panel-producto">
					    <h3 class="panel-title">{{$contingente->producto}}</h3>
					  </div>
					  <div class="panel-body">
					  	@if($contingente->normativopdf)
					   	<a href="/normativos/{{$contingente->normativopdf}}" target="_blank" id="btn{{$contingente->contingenteid}}" 
					   		class="btn btn-danger"><span class="fa fa-file-pdf-o"></span> Normativos
					   	</a>
					   	@endif
					  </div>
					</div>

		    	
		    </div>
		    
		    <?php $tipoant=$contingente->tipo; $tratadoant=$contingente->tratado; ?>
	    @endforeach
	    <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
	</div>
@stop