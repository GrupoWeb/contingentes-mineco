@extends('emails/template')
@section('titulo')
	Solicitud de emisión
@stop
@section('content')
	La solicitud de emisión con los siguientes datos: <br />
	<strong>Fecha:</strong> {{$fecha}}<br />
	<strong>Nombre:</strong> {{$nombre}}<br />
	<strong>Monto solicitado:</strong> {{ number_format($solicitado, 3) }}<br />
	@if($emitido > 0)
		<strong>Monto emitido:</strong> {{ number_format($emitido, 3) }}<br />
	@endif
	<br />
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3>

	@if(1 == 2)
		<p><a href="{{ $url }}">Presiona aquí para descargar el certificado en PDF.</a></p>
	@endif

	@if ($observaciones<>'')
	con las siguientes observaciones: <br />
		{{ $observaciones }}
	@endif
@stop