@extends('template.home')

@section('content')
	<div class="row">
	  <div class="col-md-8">
	    <img class="img-responsive img-rounded" src="/images/home.jpg" alt="Mineco">
	  </div>
	  <div class="col-md-4">
	    <h2>Tus certificados en línea</h2>
	    <p>Haz tus solicitudes de asignación e inscripción en linea, consulta tu saldo en tiempo real y obtén tus certificados fácilmente.<br>Inscribe a tu empresa accediendo al siguiente formulario. </p>
	    <a class="btn btn-primary btn-lg" href="/signup">Solicitud de Inscripción</a>
	  </div>
	</div>
	<hr>

	<div class="row">
	  <div class="col-lg-12">
	    <div class="well text-center">
	      Cualquier duda o comentario, estamos para servirle.  <strong>2412 0200</strong> ext. 4203, 4209 o 4212 
	    </div>
	  </div>
	</div>

	<div class="row info-inferior">
	  <div class="col-md-4">
	      <h2>Acuerdos comerciales</h2>
	      <p>La DACE tiene como objetivo administrar los acuerdos comerciales de carácter internacional vigentes para Guatemala, propiciando su óptimo aprovechamiento. Puedes consultar los tratados comerciales vigentes presionando el botón inferior.</p>
	      <a class="btn btn-default" href="/acuerdoscomerciales">Más información</a>
	  </div>
	  <div class="col-md-4">
	      <h2>&iquest;Ya tienes cuenta?</h2>
	      <p>Si eres un usuario existente, puedes ingresar presionando en el link inferior.  Con ello podrás solicitar tus certificados de importación o exportación en línea, consultar tu saldo o reiniciar tu contraseña.</p>
	      <a class="btn btn-default" href="/login">Iniciar sesión</a>
	  </div>
	  <div class="col-md-4">
	      <h2>Manuales</h2>
	      <p>Aquí podrás consultar los manuales de utilización del sistema en formato PDF. Los mismos los puedes descargar o consultar diretamente desde la página.</p>
	      <a class="btn btn-default" href="/manuales">Ver manuales</a>
	  </div>
	</div>
@stop