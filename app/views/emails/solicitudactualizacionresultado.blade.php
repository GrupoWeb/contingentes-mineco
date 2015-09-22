@extends('emails/template')

@section('titulo')
	Solicitud de actualización
@stop

@section('content')
	La solicitud de actualización de la empresa {{ $empresa }} solicitada por el usuario {{ $usuario }}.<br />
	<br />
	ha sido <span style="text-transform:uppercase; color: {{ $estado == 'Aprobada' ? '#0054a4' : 'red' }}"><strong>{{ $estado }}</strong></span><br> 
	@if ($observaciones<>'')
		<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop