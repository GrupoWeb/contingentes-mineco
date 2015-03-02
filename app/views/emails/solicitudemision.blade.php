@extends('emails/template')
@section('titulo')
	Solicitud de emisión
@stop
@section('content')
	Se ha recibido una solicitud de emisión con los siguientes datos: <br>
	<strong>Fecha:</strong> {{$fecha}}<br>
	<strong>Nombre:</strong> {{$nombre}}<br><br>
	La misma será revisada y recibirá un correo de confirmación cuando esta sea aprobada.
@stop