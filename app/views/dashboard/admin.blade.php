@extends('template/template')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-{{ Session::get('type') }} alert-dismissable">
			{{ Session::get('message') }}
		</div>
	@endif
	<h3 class="text-primary">Dashboard</h3>
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
@stop