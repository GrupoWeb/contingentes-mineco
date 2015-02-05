@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif
	{{--<h3 class="text-primary">Dashboard</h3>
	<h4 class="text-warning">Solicitudes pendientes</h4>
	
	<div class="row text-center">
		<div class="col-md-4">
			<h1 {{ $inscripcion > 0 ? 'class="text-danger"' : '' }}>{{ $inscripcion.'<br /><small>Inscripción</small>' }}</h1>
		</div>
		<div class="col-md-4">
			<h1 {{ $asignacion > 0 ? 'class="text-danger"' : '' }}>{{ $asignacion.'<br /><small>Asignación</small>' }}</h1>
		</div>
		<div class="col-md-4">
			<h1 {{ $emision > 0 ? 'class="text-danger"' : '' }}>{{ $emision.'<br /><small>Emisión</small>' }}</h1>
		</div>
	</div>
	<div class="row text-center">
		<div class="col-md-4">
			<a class="btn btn-xs btn-{{ $inscripcion > 0 ? 'success' : 'default disabled' }}" href="/solicitudespendientes/inscripcion/" title="Revisar">
				<span class="fa fa-users"></span>&nbsp;Revisar
			</a>
		</div>
		<div class="col-md-4">
			<a class="btn btn-xs btn-{{ $asignacion > 0 ? 'success' : 'default disabled' }}" href="/solicitudespendientes/asignacion/" title="Revisar">
				<span class="fa fa-sign-in"></span>&nbsp;Revisar
			</a>
		</div>
		<div class="col-md-4">
			<a class="btn btn-xs btn-{{ $emision > 0 ? 'success' : 'default disabled' }}" href="/solicitudespendientes/emision" title="Revisar">
				<span class="fa fa-file-pdf-o"></span>&nbsp;Revisar
			</a>
		</div>
	</div>
	<div class="clearfix"></div><br />--}}

	<?php $tid = Session::get('tselected'); ?>
	@foreach($datos as $tratadoid=>$tratado)
		@if($tratadoid == $tid || $tid == 0)
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title text-center">{{ $tratado['nombrecorto'] }}</h3>
				  </div>
				  <div class="panel-body">
				    <div class="col-md-3 text-center"><h4>{{ number_format($tratado['saldo'], 2) }}<br />Saldo</h4></div>
				    <div class="col-md-3 text-center"><h4>{{ $tratado['inscritos'] }}<br />Inscritos</h4></div>
				    <div class="col-md-3 text-center"><a href="#"><h4>{{ $tratado['contingentes'] }}<br />Contingentes</h4></a></div>
				    <div class="col-md-3 text-center"><a href="/periodos"><h4>{{ $tratado['periodos'] }}<br />Períodos</h4></a></div>
				    <div class="clearfix"></div>
				    <p>{{ $tratado['nombre'].' ('.$tratado['tipo'].')' }}</p>
				    <table class="table table-condensed table-striped">
				    	<thead>
				    		<tr>
				    			<th>Solicitud</th>
				    			<th class="text-right">Pendientes</th>
				    			<th class="text-right">Aprobadas</th>
				    			<th class="text-right">Rechazadas</th>
				    			<th class="text-right">Total</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    		@foreach($tratado['solicitudes'] as $nombre=>$datos)
				    			<?php $total = 0 ?>
				    			<tr>
				    				<td>{{ ucfirst($nombre) }}</td>
				    				@foreach($datos as $key=>$value)
				    					@if($key == 'Pendiente' && $value <> 0)
				    						<td class="text-right"><a href="#">{{ $value ? $value : 0 }} (revisar)</a></td>
				    					@else
				    						<td class="text-right">{{ $value ? $value : 0 }}</td>
				    					@endif
											<?php $total += $value; ?>
				    				@endforeach
				    				<td class="text-right"><strong>{{ $total }}</strong></td>
				    			</tr>
				    		@endforeach
				    	</tbody>
				    </table>
				  </div>
				</div>
			</div>
		@endif
	@endforeach



@stop