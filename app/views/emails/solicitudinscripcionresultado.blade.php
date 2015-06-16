@extends('emails/template')
@section('titulo')
	Solicitud de inscripción
@stop
@section('content')
	La solicitud de inscripción con los datos siguientes: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br>
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>

	@if($estado=='Aprobada')
		<strong>Usuario:</strong> {{$email}}<br>
		<strong>Contraseña:</strong> (La que ingresó en el formulario de inscripción)<br>
	@endif

	@if ($observaciones<>'')
		<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop