@extends('emails/template')
@section('content')
	<h1>Solicitud de inscripción</h1>
	La solicitud de inscripción con los siguientes datos: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br>
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>
	@if ($observaciones<>'')
	con las siguientes observaciones: <br />
		{{ $observaciones }}
	@endif
@stop