@extends('emails/template')
@section('titulo')
	Solicitud de asignación
@stop
@section('content')
	Se ha recibido una solicitud de asignación con los datos siguientes: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br><br>
	<strong>Contingente:</strong> {{$contingente}}<br><br>
	<strong>Monto:</strong> {{$monto}}<br><br>
	La misma será revisada y recibirá un correo de confirmación cuando esta sea aprobada.
@stop