@extends('emails/template')

@section('titulo')
	Solicitud de liquidación
@stop

@section('content')
	Se ha recibido una solicitud de asignación con los datos siguientes: <br>
	<strong>Nombre:</strong>{{ $nombre }}<br>
	<strong>Empresa:</strong>{{ $empresa }}<br>
	<strong>Certificado:</strong>{{ $certificado }}<br>
	<strong>Partida:</strong>{{ $partida }}<br><br>
	La misma será revisada y recibirá un correo de confirmación cuando esta sea aprobada.
@stop