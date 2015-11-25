@extends('emails/template')

@section('titulo')
	Solicitud de liquidación
@stop

@section('content')
	La solicitud de liquidación de la empresa {{ $empresa }} solicitada por el usuario {{ $usuario }}.<br />
	<br />
	ha sido <span style="text-transform:uppercase; color: {{ $estado == 'Aprobada' ? '#0054a4' : 'red' }}"><strong>{{ $estado }}</strong></span><br> 
	@if ($observaciones<>'')
		<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop