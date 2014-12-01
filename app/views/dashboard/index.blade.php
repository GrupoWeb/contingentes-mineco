@extends('template/template')

@section('content')
@if($admin)
<h3 class="text-primary">Dashboard</h3>
<h4 class="text-warning">Solicitudes pendientes</h4>
<table class="table">
	<tr class="warning">
		<td>Inscripción</td><td>2</td>
		<td>
			<a class="btn btn-xs btn-default" href="/solicitudespendientes/inscripcion/" title="Revisar">
				<span class="fa fa-users"></span>&nbsp;Revisar
			</a>
		</td>
	</tr>
	<tr>
		<td>Asignación</td><td>2</td>
		<td>
			<a class="btn btn-xs btn-default" href="#" title="Revisar">
				<span class="fa fa-sign-in"></span>&nbsp;Revisar
			</a>
		</td>
	</tr>
	<tr>
		<td>Emisión</td><td>2</td>
		<td>
			<a class="btn btn-xs btn-default" href="#" title="Revisar">
				<span class="fa fa-file-pdf-o"></span>&nbsp;Revisar
			</a>
		</td>
	</tr>
</table>
@endif
@stop