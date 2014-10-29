@extends('template/template')

@section('content')
<style>
	/* unvisited link */
	a:link {
	    color: #000;
	}

	/* visited link */
	a:visited {
	    color: #000;
	}

	/* mouse over link */
	a:hover {
	    color: #000;
	}

	/* selected link */
	a:active {
	    color: #000;
	}
</style>
  <div class="col-md-12">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h2>Inscripciones pendientes</h2>
		    <ul class="pager">
				  <li><a href="/catalogos/solicitudespendientes">Revisar solicitudes</a></li>
				</ul>
		  </div>
		  <div class="panel-body">
				<div class="row">
		  		@foreach ($solicitudes as $solicitud)
						<div class="col-md-6">
							<a href="../catalogos/solicitudespendientes/datossolicitud/{{Crypt::encrypt($solicitud->usuarioid)}}" style="text-decoration:none;">
								<div class="bs-callout bs-callout-danger">
										<dl class="dl-horizontal">
											<dt>Fecha:</dt><dd>{{$solicitud->created_at}}</dd>
											<dt>Nombre:</dt><dd>{{$solicitud->nombre}}</dd>
									    <dt>Email:</dt><dd>{{$solicitud->email}}</dd>
									    <dt>Producto:</dt><dd>{{$solicitud->nombre}}</dd>
										</dl>
								</div>
							</a>
						</div>
		  		@endforeach
				</div>
		  </div>
		</div>
	</div>
@stop