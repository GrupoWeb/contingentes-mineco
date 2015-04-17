@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif

	<div class="row">
		<div class="col-lg-4 col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-cart-plus fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $contingentes }}</div>
              <div>Contingentes inscritos</div>
            </div>
          </div>
        </div>
      </div>
	  </div>
	  <div class="col-lg-4 col-md-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-file-text-o fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $emisiones }}</div>
              <div>Solicitudes de Emisión</div>
            </div>
          </div>
        </div>
      </div>
	  </div>
	  <div class="col-lg-4 col-md-6">
      <div class="panel panel-red">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-ship fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ number_format($toneladas * -1, 3) }}</div>
              <div>Toneladas autorizadas</div>
            </div>
          </div>
        </div>
      </div>
	  </div>
  </div>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		@foreach($tratados as $tratado)
			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		      <h4 class="panel-title">
		        <a data-toggle="collapse" data-parent="#accordion" href="#id{{ $tratado->tratadoid }}" aria-expanded="true" aria-controls="collapseOne">
		          {{ $tratado->nombrecorto }}
		        </a>
		      </h4>
		    </div>
		    <div id="id{{ $tratado->tratadoid }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		      <div class="panel-body">
		      	<dl class="dl-horizontal">
						  <dt>Nombre</dt>
						  <dd>{{ $tratado->nombre }}</dd>
						  <dt>Tipo</dt>
						  <dd>{{ $tratado->tipo }}</dd>
						  <dt>Contingentes</dt>
						  <dd>{{ $tratado->contingentes }}</dd>
						</dl>
						<hr />
						<ul class="list-group">
							@foreach($productos as $producto)
								@if($producto->tratadoid == $tratado->tratadoid)
									<li class="list-group-item">{{ $producto->nombre }}</li>
								@endif
							@endforeach
						</ul>
		      </div>
		    </div>
		  </div>
		@endforeach
	</div>

@stop