@extends('emails/template')
@section('titulo')
	Solicitud de emisión
@stop
@section('content')
	La solicitud de emisión con los siguientes datos: <br />
	<strong>Fecha:</strong> {{$fecha}}<br />
	<strong>Nombre:</strong> {{$nombre}}<br />
	<strong>Contingente:</strong> {{$contingente}}<br />

	<strong>Monto solicitado:</strong> {{ number_format($solicitado, 3) }}<br />
	@if($emitido > 0)
		<strong>Monto emitido:</strong> {{ number_format($emitido, 3) }}<br />
	@endif
	<br />
	Ha sido <span style="text-transform:uppercase; color: {{ $estado == 'Aprobada' ? '#0054a4' : 'red' }}"><strong>{{ $estado }}</strong></span><br> 
	<br>
	@if(1 == 2)
		<p><a href="{{ $url }}">Presiona aquí para descargar el certificado en PDF.</a></p>
	@endif

	@if ($observaciones<>'')
	<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop