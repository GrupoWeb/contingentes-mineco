@extends('template.home')

@section('content')
	<div class="row">
	  <div class="col-md-8">
	    <img class="img-responsive img-rounded" src="/images/home.jpg" alt="Mineco">
	  </div>
	  <div class="col-md-4">
	    <h2 class="text-center landing-title" style="background-color: #f5f5f5; color:black;">Tus certificados en línea sin ningún costo</h2>
	    <p class="text-justify" style="color: white;">Haz tus solicitudes en linea, consulta tu saldo en tiempo real y obtén tus certificados fácilmente. Todas las gestiones que realice a través de este Sistema NO TIENEN NINGUN COSTO. Inscribe a tu empresa accediendo al siguiente formulario.</p>
	    <a class="btn btn-default btn-lg" href="/signup">Solicitud de Inscripción</a>
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
      <h2 class="text-center landing-title">Acuerdos comerciales</h2>
      <p class="text-justify">La DACE tiene como objetivo administrar los acuerdos comerciales de carácter internacional vigentes para Guatemala, propiciando su óptimo aprovechamiento. Puedes consultar los tratados comerciales vigentes presionando el botón inferior.</p>
      <a class="btn btn-primary" href="/acuerdoscomerciales">Más información</a>
	  </div>
	  <div class="col-md-4">
      <h2 class="text-center landing-title">&iquest;Ya tienes cuenta?</h2>
      <p class="text-justify">Si eres un usuario existente, puedes ingresar presionando en el link inferior.  Con ello podrás solicitar tus certificados de importación o exportación en línea, consultar tu saldo o reiniciar tu contraseña.</p>
      <a class="btn btn-primary" href="/login">Iniciar sesión</a>
	  </div>
	  <div class="col-md-4">
      <h2 class="text-center landing-title">Manuales</h2>
      <p class="text-justify">Aquí podrás consultar los manuales de utilización del sistema en formato PDF. Los mismos los puedes descargar o consultar diretamente desde la página.</p>
      <a class="btn btn-primary" href="/manuales">Ver manuales</a>
	  </div>
	</div><br>

	<iframe class="entity_iframe entity_iframe_node margen-iframe" frameborder="0" height="550" 
		id="iframe_herramientas_transparencia" scrolling="yes" 
		src="http://datos.transparencia.gob.gt/entity_iframe/node/16?entidad=mineco&amp;entidad_ipl_id=242&amp;"
		width="100%"></iframe>
@stop
