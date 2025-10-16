<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Contingentes Arancelarios Ministerio de Economía">
	<meta name="author" content="Softlogic, S.A.">

	<title>DACE - MINECO</title>

    <link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Archivo+Narrow|Lato:400,700'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/bootstrap.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/bootstrap-theme.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/bootstrap-datetimepicker.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/bootstrap-select.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/dataTables.bootstrap.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/dataTables.tableTools.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/core.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/bootstrapValidator.min.css'>
	<link rel="stylesheet" type="text/css" href='/packages/csgt/components/css/font-awesome.min.css'>
	<link rel="stylesheet" type="text/css" href='/css/dace.css'>
	<link rel="stylesheet" type="text/css" href='/css/selectize.css'>
	<link rel="stylesheet" type="text/css" href='/css/selectize.bootstrap3.css'>

	<script src='/packages/csgt/components/js/jquery.min.js'></script>
	<script src='/packages/csgt/components/js/moment-with-locales.min.js'></script>
	<script src='/packages/csgt/components/js/bootstrap.min.js'></script>
	<script src='/packages/csgt/components/js/bootstrap-datetimepicker.min.js'></script>
	<script src='/packages/csgt/components/js/bootstrap-select.min.js'></script>
	<script src='/packages/csgt/components/js/jquery.dataTables.min.js'></script>
	<script src='/packages/csgt/components/js/dataTables.bootstrap.js'></script>
	<script src='/packages/csgt/components/js/dataTables.tableTools.min.js'></script>
	<script src='/packages/csgt/components/js/bootstrapValidator.min.js'></script>
	<script src='/js/selectize.min.js'></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script>
		$(document).ready(function(){
			$(".alert").delay(5000).fadeOut('slow');
			$('.selectpicker').selectpicker();
			$('#cmbTratado').change(function(){
				$.get('/changetratado/' + $(this).find('option:selected').val(), function(data){
					location.reload(); 
				});
			});
		});
	</script>
	</head>
	<body>
		{{Session::get('menu')}} 
	    <div class="main main-margin">
			<div class="container">
				@if(in_array(Request::path(), Config::get('contingentes.tratadosInclude')))
					<div class="pull-right">
						<?php $tratados = Session::get('tratados'); $selected = Session::get('tselected'); ?>
						@if($tratados)
							<select class="selectpicker" id="cmbTratado">
								<option value="0" {{ (0 == $selected) ? 'selected' : '' }}>-- TODOS --</option>
								@foreach($tratados as $tratado)
									<?php $tid = $tratado->tratadoid; ?>
									<option value="{{ $tid }}" {{ ($tid == $selected) ? 'selected' : '' }}>{{ $tratado->nombrecorto }}</option>
								@endforeach
							</select>
						@endif
					</div>
					<div class="clearfix"></div>
					<br />
				@endif
				@yield('content')
			</div>
		</div>
		<div class="footer">
			<div class="col-sm-4 col-sm-offset-2">
				<p class="text-muted">8a. Avenida 10-43 Zona 1. 01001 Guatemala, C.A. PBX  (502) 2412-0200</p>
				<p class="text-muted">Horarios de atención Lunes a Viernes 08:00 - 16:00Hrs</p>
			</div>
			<div class="col-sm-4 text-right">
				<p><a href="https://www.mineco.gob.gt/contactenos" target="_blank">Contáctenos</a></p>
				<p><a href="http://mineco.gob.gt/directorio-sedes-departamentales-y-municipales" target="_blank">Directorio de sedes departamentales, municipales</a></p>
				<p>Última Actualización 29/09/2020</p>
			</div>
			<div class="clearfix"></div>
			<hr>
			<p class="text-muted text-center">
				Todos los derechos reservados | <a href="https://contingentesarancelarios.mineco.gob.gt/">contingentesarancelarios.mineco.gob.gt</a> | 2015-{{ date('Y') }} | Powered by <a href="https://softlogic.com.gt" target="_blank">Softlogic, S.A.</a>
			</p>
		</div>
	</body>
</html>