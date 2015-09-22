@extends('emails/template')

@section('titulo')
	Solicitud de actualización
@stop

@section('content')
	Se ha recibido una solicitud de actualización de datos de la empresa {{ $empresa }}, solicitada por el usuario {{ $usuario }}.<br />
	<br />
@stop