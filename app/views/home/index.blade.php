@extends('template/template')

@section('content')
	@if(Auth::user()->rolid == 2)
	    {{-- dd($solicitudes); --}}
	  <div class="col-md-6">
			<div class="panel panel-warning">
			  <div class="panel-heading">
			    <h2>Inscripciones pendientes</h2>
			    <ul class="pager">
					  <li><a href="catalogos/solicitudespendientes">Revisar solicitudes</a></li>
					</ul>
			  </div>
			  <div class="panel-body">
			  	@foreach ($solicitudes as $solicitud)
						<div class="bs-callout bs-callout-danger">
							<div class="row">
								<dl class="dl-horizontal">
									<dt>Fecha:</dt><dd>{{$solicitud->created_at}}</dd>
									<dt>Nombre:</dt><dd>{{$solicitud->nombre}}</dd>
							    <dt>Email:</dt><dd>{{$solicitud->email}}</dd>
							    <dt>Producto:</dt><dd>{{$solicitud->nombre}}</dd>
								</dl>
							</div>
						</div>
			  	@endforeach
			  </div>
			</div>
		</div>
	@endif
@stop