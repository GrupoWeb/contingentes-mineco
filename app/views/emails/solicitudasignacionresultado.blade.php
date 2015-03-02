@extends('emails/template')
@section('titulo')
	Solicitud de asignación
@stop
@section('content')
	La solicitud de asignación con los siguientes datos: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br>
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>
	@if ($observaciones<>'')
		con las siguientes observaciones: <br />
		{{ $observaciones }}
	@endif
@stop