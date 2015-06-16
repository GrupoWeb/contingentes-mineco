@extends('emails/template')
@section('titulo')
	Solicitud de asignación
@stop
@section('content')
	La solicitud de asignación con los datos siguientes: <br />
	<strong>Fecha:</strong> {{$fecha}}<br />
	<strong>Nombre:</strong> {{$nombre}}<br />
	<strong>Contingente:</strong> {{$contingente}}<br />
	<strong>Monto solicitado:</strong> {{ number_format($solicitado, 3) }}<br />
	@if($asignado > 0)
		<strong>Monto asignado:</strong> {{ number_format($asignado, 3) }}<br />
	@endif
	<br />
	ha sido <h3 style="color: {{ $estado == 'Aprobada' ? 'green' : 'red' }}">{{ $estado }}</h3> 
	@if ($observaciones<>'')
		<strong>Observaciones:</strong><br />
		{{ $observaciones }}
	@endif
@stop