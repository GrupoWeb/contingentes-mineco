@extends('emails/template')
@section('titulo')
	Solicitud de inscripción
@stop
@section('content')
	La solicitud de inscripción con los datos siguientes: <br><br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br>
	<br><br>
	ha sido <span style="text-transform:uppercase; color: {{ $estado == 'Aprobada' ? '#0054a4' : 'red' }}"><strong>{{ $estado }}</strong></span>
	<br><br><br>
	@if($estado=='Aprobada')
		<strong>Usuario:</strong> {{$email}}<br>
		<strong>Contraseña:</strong> (La que ingresó en el formulario de inscripción)<br>
	@endif

	@if ($observaciones<>'')
		<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop