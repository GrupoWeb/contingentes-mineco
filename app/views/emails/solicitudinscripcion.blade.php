@extends('emails/template')
@section('titulo')
	Solicitud de inscripción
@stop
@section('content')
	Estimad(a) Usuari(a): {{ $nombre }} <br /><br />
	Se ha registrado una solicitud de inscripción en el Sistema de Contingentes Arancelarios, la cual será revisada para su autorización. En breve recibirá un correo dando respuesta a su solicitud.
<br />
@stop