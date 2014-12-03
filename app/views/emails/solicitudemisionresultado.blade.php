@extends('emails/template')
@section('content')
	<h1>Solicitud de emisión</h1>
	La solicitud de emisión con los siguientes datos: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br>
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>

	<p><a href="{{ $url }}">Presiona aquí para ver tu certificado</a></p>

	@if ($observaciones<>'')
	con las siguientes observaciones: <br />
		{{ $observaciones }}
	@endif
@stop